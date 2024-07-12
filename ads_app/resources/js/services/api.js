import axios from "axios";
import Interceptors from '@/services/interceptors.service';
import { getCsrfToken } from '@/utils/csrfToken';

const CSRF_TOKEN = getCsrfToken();

const api = axios.create({
    baseURL: 'rest/api/',
    headers: {
        "Content-Type": "application/json",
        'X-CSRF-TOKEN': CSRF_TOKEN,
    }
});

/**
 * Every API request incoming
 */
Interceptors.request(api);

/**
 * Every API response incoming
 */
Interceptors.response(api);


export default api;
