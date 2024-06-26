import {useCookies} from "vue3-cookies";

class Cookie {
    constructor() {
        const {cookies} = useCookies();
        this.cookie = cookies;
    }

    get(key) {
        return this.cookie.get(key)
    }

    set(key, value, expire = null, path = null, domain = null, secure = null, sameSite = null) {
        return this.cookie.set(key, value, expire, path, domain, secure, sameSite)
    }

    remove(keyName) {
        return this.cookie.remove(keyName);
    }
}

export default new Cookie();
