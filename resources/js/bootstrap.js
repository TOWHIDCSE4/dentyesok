window._ = require('lodash');

import {Notification, Message} from "element-ui";
/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */


window.axios.interceptors.response.use(function (response) {
    const {data: {msg}} = response;
    if (msg) {
        Message.success({
            message: msg
        })
    }
    return response;
}, function (error) {
    const {status, data: {msg}} = error.response;
    if(status <= 500 && status != 422) {
        Notification.error({
            title: 'Error',
            message: msg || "Something went wrong."
        })
    }
    return Promise.reject(error)
});

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
