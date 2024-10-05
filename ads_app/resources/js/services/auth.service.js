import api from "@/services/api";

class AuthService {
    userLogin(credentials) {
        return api.post("auth/login", credentials);
    }

    userLogout() {
        return api.post("auth/logout");
    }

    refreshToken() {
        return api.post("auth/refresh");
    }
}

export default new AuthService();
