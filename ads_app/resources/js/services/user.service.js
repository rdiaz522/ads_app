import api from '@/services/api';

class User {
    getUser() {
        return api.get('/user');
    }

    register(data) {
        return api.post('user/register', data);
    }
}

export default new User();
