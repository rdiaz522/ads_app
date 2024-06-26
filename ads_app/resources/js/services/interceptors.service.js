import TokenService from '@/services/token.service';
import store from '@/store';
import SessionService from '@/services/session.service';
import { useToast } from 'vue-toastification'

class Interceptors {
    constructor() {
        this.token = TokenService.getToken('token');
        this.store = store;
        this.toast = useToast();
    }

    request(api) {
        api.interceptors.request.use(async (config) => {
            this.store.commit('Loading/PAGE_LOAD', true);
            if (this.token) {
                config.headers['Authorization'] = 'Bearer ' + this.token;
            }

            return config;
        }, error => {
            return Promise.reject(error);
        });
    }

    response(api) {
        api.interceptors.response.use(async (response) => {
            this.store.dispatch('Sessions/startTimer', 180);

            let authorization = await response.headers['authorization'];
            // Check for the new token in the Authorization header
            if (authorization) {
                this.token = response.headers['authorization'].split(' ')[1];
                TokenService.setToken(this.token);
            }

            this.store.commit('Loading/PAGE_LOAD', false);
            return response;
        }, async (error) => {
            let isAuthorized = await this.isAuthorized(error);
            if (!isAuthorized) {
                SessionService.logoutSession();
                this.store.dispatch('Sessions/stopTimer');
                window.location.href = '/';

            } else {
                this.store.commit('Loading/PAGE_LOAD', false);
            }

            return Promise.reject(error);
        });
    }

    async isAuthorized(error) {
        if (error.response.status === 401 && this.token) {
            return false;
        }

        return true;
    }
}

export default new Interceptors();
