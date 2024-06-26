import axios from "axios";
import Interceptors from '@/services/interceptors.service';
import Cookie from '@/services/cookie.service';

const CSRF_TOKEN = Cookie.get('XSRF-TOKEN');

const api = axios.create({
    baseURL: 'rest/api/',
    headers: {
        "Content-Type": "application/json",
        'X-CSRF-TOKEN': CSRF_TOKEN,
    }
});

/**
 * Every request incoming
 */
Interceptors.request(api);

/**
 * Every response incoming
 */
Interceptors.response(api);


export default api;
