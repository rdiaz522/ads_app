class TokenService {
    setToken(token, name = "token") {
        return localStorage.setItem(name, token);
    }

    getToken(key) {
        return localStorage.getItem(key);
    }

    removeToken(key) {
        return localStorage.removeItem(key);
    }
}

export default new TokenService();
