/**
 * Router.js - Simple SPA routing system
 */

let firstInit = true;

const Router = {
    routes: {},
    currentRoute: null,
    currentParams: {},

    list: [
        {
            path: "/",
            title: "Home",
            template: "home.html",
            callback: () => console.log("Home page loaded"),
        },
        {
            path: "/tax/pph21/bulanan",
            title: "Pajak PPh21 Bulanan",
            template: "tax/pph21/bulanan.html",
            callback: function(params) {
                if (params.id) {
                    switch (params.action) {
                        case 'edit':
                            return editDetailBUlananPPh21(params.id);
                        case 'view':
                            return viewDetailBulananPPh21(params.id);
                        default:
                            break;
                    }
                }
                loadListingBulananPPh21();
            }
        },
/*         {
            path: "/tax/pph21/bulanan",
            title: "Pajak PPh21 Bulanan",
            template: "tax/pph21/bulanan.html",
            callback: function () {},
        }, */
        {
            path: "/master/pegawai",
            title: "Master Pegawai",
            template: "master/pegawai.html",
            callback: function(params) {
                if (params.id) {
                    switch (params.action) {
                        case 'edit':
                            return loadEmployeeForEditing(params.id);
                        case 'view':
                            return displayEmployeeDetails(params.id);
                        default:
                            break;
                    }
                }
                loadListing();
            }
        },

        
        {
            path: "/master/ptkp",
            title: "Master PTKP",
            template: "master/ptkp.html",
            callback: function () {},
        },
        {
            path: "/master/ter",
            title: "Master TER",
            template: "master/ter.html",
            callback: function () {},
        },
        {
            path: "/admin/users",
            title: "User Management",
            template: "admin/users.html",
            callback: function () {},
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
     * Navigate to a route with optional parameters
     * @param {string} path - Route path
     * @param {object} params - Optional parameters to pass
     */
    navigateWithParams(path, params = {}) {
        // Convert params to query string
        const queryString = Object.keys(params)
            .map(
                (key) =>
                    `${encodeURIComponent(key)}=${encodeURIComponent(
                        params[key]
                    )}`
            )
            .join("&");

        // Update hash with optional query string
        window.location.hash = path + (queryString ? `?${queryString}` : "");
    },

    /**
     * Enhanced navigate method to parse parameters
     * @param {string} hash - URL hash including path and optional parameters
     */
    navigate(hash) {
        // Split path and query string
        const [pathWithoutParams, queryString] = hash.substring(1).split("?");
        const path = pathWithoutParams || "/";

        // Parse parameters
        const params = {};
        if (queryString) {
            queryString.split("&").forEach((param) => {
                const [key, value] = param.split("=");
                params[decodeURIComponent(key)] = decodeURIComponent(value);
            });
        }

        // Store current route and params
        this.currentRoute = path;
        this.currentParams = params;

        const route = this.routes[path];
        route ? this.loadPage(route, params) : this.showNotFound();
    },

    /**
     * Modified loadPage to accept parameters
     * @param {object} route - Route configuration
     * @param {object} params - Route parameters
     */
    loadPage(route, params = {}) {
        if (!firstInit) {
            Global.showLoading();
        }
        firstInit = false;
        document.title = `${route.title} | ${CONFIG.appName}`;

        $.get(`pages/${route.template}`)
            .done((content) => {
                $("#app").html(content);

                // Pass params to callback if exists
                if (typeof route.callback === "function") {
                    route.callback(params);
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
