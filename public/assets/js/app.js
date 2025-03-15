/**
 * App.js - Main application entry point
 */
$(document).ready(function () {
    
    Router.list.forEach((route) => {
        Router.add(route.path, {
            title: route.title,
            template: route.template,
            callback: route.callback, // Menggunakan function, bukan arrow function
        });
    });

    // Initialize the router
    Router.init();

    if (CONFIG.debug) {
        console.log("Application initialized successfully");
    }

    Global.checkToken();
});
