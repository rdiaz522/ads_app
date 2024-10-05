import axios from "axios";
import Interceptors from '@/services/interceptors.service';

const api = axios.create({
    baseURL: 'rest/api/v1',
    headers: {
        "Content-Type": "application/json"
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
