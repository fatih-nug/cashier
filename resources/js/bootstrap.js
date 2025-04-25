// Import Bootstrap library
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

// Import Axios for HTTP requests
import axios from 'axios';
window.axios = axios;

// Set default headers
window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'Accept': 'application/json'
};

// Add response interceptor
window.axios.interceptors.response.use(
    response => response,
    error => {
        if (error.response && error.response.status === 419) {
            // Handle expired CSRF token
            window.location.reload();
        }
        return Promise.reject(error);
    }
);

// Add Bootstrap icons
import 'bootstrap-icons/font/bootstrap-icons.css';

// Add custom scripts
document.addEventListener('DOMContentLoaded', () => {
    // Enable tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Enable popovers
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
});

/**
 * Uncomment berikut ini untuk mengaktifkan Laravel Echo
 */
/*
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});
*/
