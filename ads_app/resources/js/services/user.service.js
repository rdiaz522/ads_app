import api from '@/services/api';

class User {
    getUser() {
        return api.get('/user');
    }
}

export default new User();
