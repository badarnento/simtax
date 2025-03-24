/**
 * Global.js - Common utility functions
 */
const Global = {
    /**
     * Show a notification message
     * @param {string} message - Message to display
     * @param {string} type - Type of message (success, error, warning, info)
     * @param {number} duration - How long to show the message in ms
     */
    showNotification: function (
        message,
        type = CONSTANTS.MESSAGE.INFO,
        duration = 3000
    ) {
        // Remove any existing notifications
        $(".notification").remove();

        // Create notification element
        const notification = $(`
            <div class="notification ${type}">
                <div class="notification-content">${message}</div>
                <span class="notification-close">&times;</span>
            </div>
        `);

        // Add to DOM
        $("body").append(notification);

        // Show notification with animation
        setTimeout(() => {
            notification.addClass("show");
        }, 10);

        // Set timeout to hide notification
        if (duration) {
            setTimeout(() => {
                this.hideNotification(notification);
            }, duration);
        }

        // Add close button event
        notification.find(".notification-close").on("click", function () {
            Global.hideNotification(notification);
        });
    },

    /**
     * Hide a notification
     * @param {jQuery} notification - Notification element to hide
     */
    hideNotification: function (notification) {
        notification.removeClass("show");
        setTimeout(() => {
            notification.remove();
        }, CONFIG.animationSpeed);
    },

    toastNotif: function (messages, type = "success") {
        if (type == "success") {
            console.log('sukses nih');
            toastr.success(messages, "Success", 3);
        } else {
            toastr.error(messages, "Error");
        }
    },

    /**
     * Format date to a readable string
     * @param {string|Date} date - Date to format
     * @param {string} format - Format string (simple)
     * @returns {string} Formatted date string
     */
    formatDate: function (date, format = "YYYY-MM-DD") {
        const d = new Date(date);

        const year = d.getFullYear();
        const month = String(d.getMonth() + 1).padStart(2, "0");
        const day = String(d.getDate()).padStart(2, "0");
        const hours = String(d.getHours()).padStart(2, "0");
        const minutes = String(d.getMinutes()).padStart(2, "0");

        return format
            .replace("YYYY", year)
            .replace("MM", month)
            .replace("DD", day)
            .replace("HH", hours)
            .replace("mm", minutes);
    },

    /**
     * Serialize form data to JSON object
     * @param {jQuery} form - jQuery form element
     * @returns {object} Form data as JSON object
     */
    serializeForm: function (form) {
        const formData = {};

        form.serializeArray().forEach((item) => {
            formData[item.name] = item.value;
        });

        return formData;
    },

    /**
     * Make an AJAX request
     * @param {string} url - URL to call
     * @param {string} method - HTTP method
     * @param {object} data - Data to send
     * @param {function} successCallback - Success callback
     * @param {function} errorCallback - Error callback
     */
    ajax: function (
        url,
        method = "GET",
        data = null,
        successCallback = null,
        errorCallback = null
    ) {
        let fullUrl = CONFIG.getApiUrl(url); // Tambahkan prefix API

        let isFormData = data instanceof FormData;

        $.ajax({
            url: fullUrl,
            type: method,
            data: isFormData ? data : JSON.stringify(data),
            contentType: isFormData ? false : "application/json",
            processData: !isFormData,
            cache: false,
            dataType: "json",
            timeout: CONFIG.ajaxTimeout,
            success: function (response) {
                if (successCallback && typeof successCallback === "function") {
                    successCallback(response);
                }
            },
            error: function (xhr, status, error) {
                if (errorCallback && typeof errorCallback === "function") {
                    errorCallback(xhr, status, error);
                } else {
                    Global.showNotification(
                        "An error occurred: " + error,
                        CONSTANTS.MESSAGE.ERROR
                    );
                }
            },
        });
    },

    /**
     * Check if a string is valid JSON
     * @param {string} str - String to check
     * @returns {boolean} True if valid JSON
     */
    isValidJSON: function (str) {
        try {
            JSON.parse(str);
            return true;
        } catch (e) {
            return false;
        }
    },

    /**
     * Get value from local storage with expiry check
     * @param {string} key - Storage key
     * @returns {any} Stored value or null if expired/not found
     */
    getFromStorage: function (key) {
        const item = localStorage.getItem(key);

        if (!item) return null;

        // Check if the item is JSON with expiry data
        if (this.isValidJSON(item)) {
            const parsed = JSON.parse(item);

            // If it has expiry timestamp, check it
            if (parsed.expiry && parsed.data) {
                if (new Date().getTime() > parsed.expiry) {
                    // Expired, remove item
                    localStorage.removeItem(key);
                    return null;
                }

                return parsed.data;
            }
        }

        return item;
    },

    /**
     * Set value in local storage with expiry
     * @param {string} key - Storage key
     * @param {any} value - Value to store
     * @param {number} expiryMinutes - Minutes until expiry
     */
    setInStorage: function (
        key,
        value,
        expiryMinutes = CONFIG.cacheExpiration
    ) {
        if (expiryMinutes) {
            const expiry = new Date().getTime() + expiryMinutes * 60 * 1000;
            const item = {
                data: value,
                expiry: expiry,
            };

            localStorage.setItem(key, JSON.stringify(item));
        } else {
            // No expiry, store directly
            if (typeof value === "object") {
                localStorage.setItem(key, JSON.stringify(value));
            } else {
                localStorage.setItem(key, value);
            }
        }
    },
    showLoading: function () {
        $("#loading").addClass("active"); // Fade in
    },

    hideLoading: function () {
        setTimeout(() => {
            $("#loading").removeClass("active"); // Fade out
        }, 300); // Tambahkan sedikit delay agar lebih smooth
    },

    checkToken() {
        let token = getCookie("token");

        if (!token) {
            window.location.href = "/login";
        } else {
            /*  fetch("/api/v1.0/me", {
                method: "GET",
                headers: {
                    Authorization: "Bearer " + token,
                    "Content-Type": "application/json",
                },
            })
                .then((response) => {
                    if (!response.ok) {
                        document.cookie =
                            "token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                        window.location.href = "/login";
                    }
                })
                .catch((error) => {
                    console.error("Token validation failed:", error);
                    window.location.href = "/login";
                }); */
        }
    },
};
