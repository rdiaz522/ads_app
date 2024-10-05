import TokenService from '@/services/token.service';
import Cookie from '@/services/cookie.service';

class Session {
    setSessionTimer(time) {

    }

    getSessionTimer() {

    }

    logoutSession() {
        TokenService.removeToken('token');
        TokenService.removeToken('CSRF_TOKEN');
        Cookie.remove('XSRF-TOKEN');
    }
}

export default new Session();
