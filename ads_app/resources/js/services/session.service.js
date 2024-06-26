import TokenService from '@/services/token.service';
import Cookie from '@/services/cookie.service';

class Session {
    setSessionTimer(time) {

    }

    getSessionTimer() {

    }

    logoutSession() {
        TokenService.removeToken('token');
        Cookie.remove('XSRF-TOKEN');
    }
}

export default new Session();
