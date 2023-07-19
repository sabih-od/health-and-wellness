import 'bootstrap';

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
import Echo from 'laravel-echo';
import Pusher from "pusher-js";

window.axios = axios;
window.Pusher = Pusher

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.e
 */


var pusherKey = "9bc664b0ccbe734af34c";
var pusherCluster = "284cdeb99fbcfe976912";

// console.log("opop" , pusherKey , pusherCluster);


window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '9bc664b0ccbe734af34c',
    authEndpoint: "https://service.demowebsitelinks.com/health-and-wellness/public/broadcasting/auth",
    cluster: 'ap2',
    // encrypted: true,
    forceTLS: true

    // Add additional configuration options as needed
});
