import TokenService from "@/services/token.service";
import store from "@/store";
import SessionService from "@/services/session.service";
import { useToast } from "vue-toastification";
import { getCsrfToken } from "@/utils/csrfToken";

const exceptRoutes = ["auth/login"];

class Interceptors {
    /**
     * Initialize the token
     * Initialize the Vuex (store)
     * Initialize Toast for notification
     */
    constructor() {
        TokenService.setToken(getCsrfToken(), "CSRF_TOKEN");
        this.store = store;
        this.toast = useToast();
    }

    /**
     *  Every API Request will go through to this function
     * @param api
     */
    request(api) {
        api.interceptors.request.use(
            async (config) => {
                this.onPageLoad();
                this.token = TokenService.getToken("token");
                if (this.token) {
                    config.headers["Authorization"] = "Bearer " + this.token;
                    config.headers["X-CSRF-TOKEN"] =
                        TokenService.getToken("CSRF_TOKEN");
                }

                return config;
            },
            (error) => {
                return Promise.reject(error);
            }
        );
    }

    /**
     * Every API Response will go through to this function
     * @param api
     */
    response(api) {
        api.interceptors.response.use(
            async (response) => {
                this.initializeSessionTimer();
                await this.setAuthHeader(response);
                this.onPageLoad(false);
                return response;
            },
            async (error) => {
                if (!this.isRouteExclude(error.config)) {
                    let isAuthorized = await this.isAuthorized(error);
                    if (!isAuthorized) {
                        SessionService.logoutSession();
                        this.initializeSessionTimer(true);
                        window.location.href = "/";
                    } else {
                        this.onPageLoad(false);
                        this.initializeSessionTimer();
                    }

                    await this.setAuthHeader(error.response);

                    if (error.response.data.message) {
                        this.toast.error(error.response.data.message);
                    }
                }

                this.onPageLoad(false);

                const errorResponse = this.errorResponse(error);

                return errorResponse;
            }
        );
    }

    /**
     * Handle User Authorization
     * It will check the response status
     * if the status is 401 it will return false (Unauthorized)
     * @param error
     * @returns {Promise<boolean>}
     */
    async isAuthorized(error) {
        if (error.response.status === 401 || !this.token) {
            return false;
        }

        return true;
    }

    /**
     * If the token is refresh from the backend
     * the header authorization should set the refreshed token
     * @param response
     * @returns {Promise<*>}
     */
    async setAuthHeader(response) {
        if (response.headers["authorization"]) {
            let authorization = await response.headers["authorization"];
            // Check for the new token in the Authorization header
            if (authorization) {
                this.token = response.headers["authorization"].split(" ")[1];
                TokenService.setToken(this.token);
            }
        }
        return response;
    }

    /**
     * Check if the route is not include through the API Interceptor
     * @param config
     * @returns {boolean}
     */
    isRouteExclude(config) {
        const url = config.url;
        if (exceptRoutes.includes(url)) {
            return true;
        }

        return false;
    }

    /**
     * Initialize Session Timer
     * @param isStop
     */
    initializeSessionTimer(isStop = false) {
        if (!isStop) {
            this.store.dispatch("Sessions/startTimer");
        } else {
            this.store.dispatch("Sessions/stopTimer");
        }
    }

    /**
     * Initialize Page Loading
     * @param isLoading
     */
    onPageLoad(isLoading = true) {
        this.store.commit("Loading/PAGE_LOAD", isLoading);
    }

    errorResponse(error) {
        if (error.response) {
            const errorResponse = Promise.reject(error);
            switch (error.response.status) {
                case 422:
                case 401:
                    return Promise.reject(error.response.data.errors);
                default:
                    return errorResponse;
            }
        }
    }
}

export default new Interceptors();
