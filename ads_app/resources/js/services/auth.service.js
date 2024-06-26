import api from '@/services/api';

class AuthService {
    userLogin(credentials) {
        return api.post('auth/login', credentials);
    }

    userLogout() {
        return api.post('auth/logout');
    }
}


export default new AuthService();
