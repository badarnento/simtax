/**
 * Router.js - Simple SPA routing system
 */

let firstInit = true;

const Router = {
    routes: {},
    currentRoute: null,
    callback: () => console.log("Home page loaded"),

    list: [
        {
            path: "/",
            title: "Home",
            template: "home.html",
            callback: () => console.log("Home page loaded"),
        },
        {
            path: "/master/pegawai",
            title: "Master Pegawai",
            template: "master/pegawai.html",
            callback: function () {
            },
        },
        {
            path: "/admin/users",
            title: "User Management",
            template: "admin/users.html",
            callback: function () {
            },
        },
    ],

    /**
     * Initialize the router
     */
    init() {
        this.navigate(window.location.hash);

        // Listen for hash changes to handle navigation
        $(window).on("hashchange", () => this.navigate(window.location.hash));
    },

    /**
     * Add a route to the router
     * @param {string} path - The route path (e.g., '/about')
     * @param {object} config - Route configuration object
     */
    add(path, config) {
        this.routes[path] = config;
        return this;
    },

    /**
     * Navigate to a specific route
     * @param {string} hash - URL hash including the path
     */
    navigate(hash) {
        const path = hash.substring(1) || "/";
        this.currentRoute = path;

        const route = this.routes[path];
        route ? this.loadPage(route) : this.showNotFound();
    },

    /**
     * Load page content based on route configuration
     * @param {object} route - Route configuration object
     */
    loadPage(route) {

        if (!firstInit) {
            Global.showLoading();
        }
        firstInit = false;
        document.title = `${route.title} | ${CONFIG.appName}`;

        $.get(`pages/${route.template}`)
            .done((content) => {
                $("#app").html(content);

                if (typeof route.callback === "function") {
                    route.callback();
                }

                this.updateActiveNav();
                Global.hideLoading();
            })
            .fail(() => {
                $("#app").html(
                    '<div class="error-page"><h1>Error</h1><p>Failed to load page content</p></div>'
                );
            });
    },

    /**
     * Show 404 Not Found page
     */
    showNotFound() {
        const notFoundHtml = `
            <div class="page-error page-error-404 text-center">
                <div class="page-content vertical-align-middle">
                    <header>
                        <h1 class="animation-slide-top">404</h1>
                        <p>Page Not Found !</p>
                    </header>
                    <a class="btn btn-primary btn-round waves-effect waves-classic" href="/#">Go Back</a>
                </div>
            </div>
        `;
        $("#app").html(notFoundHtml);
        document.title = `404 - Page Not Found | ${CONFIG.appName}`;
    },

    /**
     * Update active navigation link
     */
    updateActiveNav() {
        $(".nav-link").removeClass("active");
        $(`.nav-link[href="#${this.currentRoute}"]`).addClass("active");
    },
};
