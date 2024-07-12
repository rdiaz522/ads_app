import TokenService from '@/services/token.service';
import store from '@/store';
import SessionService from '@/services/session.service';
import { useToast } from 'vue-toastification'

class Interceptors {

    /**
     * Initialize the token
     * Initialize the Vuex (store)
     * Initialize Toast for notification
     */
    constructor() {
        this.token = TokenService.getToken('token');
        this.store = store;
        this.toast = useToast();
    }

    /**
     *  Every API Request will go through to this function
     * @param api
     */
    request(api) {
        api.interceptors.request.use(async (config) => {
            this.onPageLoad();
            if (this.token) {
                config.headers['Authorization'] = 'Bearer ' + this.token;
            }

            return config;
        }, error => {
            return Promise.reject(error);
        });
    }

    /**
     * Every API Response will go through to this function
     * @param api
     */
    response(api) {
        api.interceptors.response.use(async (response) => {
            this.initializeSessionTimer();
            this.setAuthHeader(response);
            this.onPageLoad(false);
            return response;
        }, async (error) => {
            let isAuthorized = await this.isAuthorized(error);
            if (!isAuthorized) {
                SessionService.logoutSession();
                this.initializeSessionTimer(true);
                window.location.href = '/';

            } else {
                this.onPageLoad(false)
                this.initializeSessionTimer();
            }

            this.setAuthHeader(error.response);
            this.toast.error(error.response.data.message);
            return Promise.reject(error);
        });
    }

    /**
     * Handle User Authorization
     * It will check the response status
     * if the status is 401 it will return false (Unauthorized)
     * @param error
     * @returns {Promise<boolean>}
     */
    async isAuthorized(error) {
        if (error.response.status === 401) {
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
        if (response.headers['authorization']) {
            let authorization = await response.headers['authorization'];
            // Check for the new token in the Authorization header
            if (authorization) {
                this.token = response.headers['authorization'].split(' ')[1];
                TokenService.setToken(this.token);
            }
        }
        return response;
    }

    /**
     * Initialize Session Timer
     * @param isStop
     */
    initializeSessionTimer(isStop = false) {
        if (!isStop) {
            this.store.dispatch('Sessions/startTimer', 180);
        } else {
            this.store.dispatch('Sessions/stopTimer');
        }
    }

    /**
     * Initialize Page Loading
     * @param isLoading
     */
    onPageLoad(isLoading = true) {
        this.store.commit('Loading/PAGE_LOAD', isLoading);
    }



}

export default new Interceptors();
