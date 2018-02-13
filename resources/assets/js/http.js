import axios from 'axios'
import env from './config/loadEnv'
const baseURL = env.baseURL
export const http = axios.create({baseURL: baseURL})


http.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
   http.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

export default function install (Vue) {
    Vue.prototype.$http = http
}

