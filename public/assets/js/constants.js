/**
 * Constants.js - Application constants
 */
const CONSTANTS = {
    // HTTP status codes
    HTTP: {
        OK: 200,
        CREATED: 201,
        BAD_REQUEST: 400,
        UNAUTHORIZED: 401,
        FORBIDDEN: 403,
        NOT_FOUND: 404,
        SERVER_ERROR: 500,
    },

    // Local storage keys
    STORAGE: {
        USER_TOKEN: "user_token",
        USER_DATA: "user_data",
        SETTINGS: "user_settings",
        THEME: "app_theme",
    },

    // Message types
    MESSAGE: {
        SUCCESS: "success",
        ERROR: "error",
        WARNING: "warning",
        INFO: "info",
    },

    // Animation classes
    ANIMATION: {
        FADE_IN: "fade-in",
        FADE_OUT: "fade-out",
        SLIDE_UP: "slide-up",
        SLIDE_DOWN: "slide-down",
    },

    // Form validation
    VALIDATION: {
        EMAIL_REGEX: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
        PHONE_REGEX: /^\+?[0-9]{8,15}$/,
        MIN_PASSWORD_LENGTH: 8,
    },

    LOADING_DATATABLE: `<div class="example-loading example-well h-150 vertical-align text-center">
    <div class="loader vertical-align-middle loader-grill"></div>
  </div>`,
};
