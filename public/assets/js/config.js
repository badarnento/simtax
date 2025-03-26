/**
 * Config.js - Application configuration settings
 */
const CONFIG = {
    // Application basics
    appName: 'SIMTAX',
    version: '1.0.0',
    
    // API settings
    webUrl: '/#',
    apiUrl: '/api',
    apiVersion: 'v1.0',
    
    // Debug mode
    debug: true,
    
    // Cache settings
    cacheExpiration: 30, // minutes
    
    // Timeouts
    ajaxTimeout: 30000, // ms
    
    // Animation settings
    animationSpeed: 300, // ms
    
    /**
     * Get full API URL with endpoint
     * @param {string} endpoint - API endpoint to call
     * @returns {string} Full API URL
     */
    getApiUrl: function(endpoint) {
        return this.apiUrl + '/' + this.apiVersion + '/' + endpoint;
    }

};