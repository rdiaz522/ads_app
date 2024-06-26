class TokenService {

    setToken($token) {
        return localStorage.setItem('token', $token)
    }

    getToken($key) {
        return localStorage.getItem($key);
    }

    removeToken($key) {
        return localStorage.removeItem($key)
    }
}

export default new TokenService();
