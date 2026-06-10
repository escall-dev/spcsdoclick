/**
 * Auth Token - Multi-tab session support
 * Stores token in sessionStorage and cookies (per-tab isolation)
 * WITHOUT exposing the token in the URL.
 */
(function() {
    var AUTH_TOKEN_KEY = 'auth_token';
    var TAB_ID_KEY = 'tab_id';
    var APP_URL = (typeof window.SDO_BACTRACK_APP_URL !== 'undefined') ? window.SDO_BACTRACK_APP_URL : '/SDO-BACtrack';
    var TOKEN_PARAM = (typeof window.SDO_BACTRACK_TOKEN_PARAM !== 'undefined') ? window.SDO_BACTRACK_TOKEN_PARAM : 'auth_token';
    var ADMIN_PREFIX = APP_URL + '/admin/';

    function getCookieName() {
        return TOKEN_PARAM;
    }

    function getCookie(name) {
        var value = "; " + document.cookie;
        var parts = value.split("; " + name + "=");
        if (parts.length === 2) return parts.pop().split(";").shift();
        return null;
    }

    function setCookie(name, value, hours) {
        var expires = "";
        if (hours) {
            var date = new Date();
            date.setTime(date.getTime() + (hours * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        var path = APP_URL + '/';
        document.cookie = name + "=" + (value || "") + expires + "; path=" + path + "; SameSite=Lax";
    }

    function deleteCookie(name) {
        var path = APP_URL + '/';
        document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=" + path + ";";
    }

    // Capture token if it happens to be in URL (e.g., legacy links) and clean the URL
    function storeTokenFromUrl() {
        var params = new URLSearchParams(window.location.search);
        var tokenFromUrl = params.get(TOKEN_PARAM);

        if (tokenFromUrl) {
            try {
                sessionStorage.setItem(AUTH_TOKEN_KEY, tokenFromUrl);
                setCookie(getCookieName(), tokenFromUrl, 8);
                
                // Clean URL
                var url = new URL(window.location.href);
                url.searchParams.delete(TOKEN_PARAM);
                window.history.replaceState({}, document.title, url.toString());
            } catch (e) {}
            return;
        }

        var storedToken = sessionStorage.getItem(AUTH_TOKEN_KEY);
        var cookieToken = getCookie(getCookieName());

        if (storedToken) {
            if (storedToken !== cookieToken) {
                // Mismatch! This tab has a different session than the active cookie.
                // Restore this tab's cookie and reload to get the correct data from PHP.
                setCookie(getCookieName(), storedToken, 8);
                window.location.reload();
            }
        } else if (cookieToken) {
            // New tab or fresh session, inherit from cookie
            try {
                sessionStorage.setItem(AUTH_TOKEN_KEY, cookieToken);
            } catch (e) {}
        }
    }

    function clearAuthCookie() {
        try {
            deleteCookie(getCookieName());
            sessionStorage.removeItem(AUTH_TOKEN_KEY);
        } catch (e) {}
    }

    // Instead of adding token to URLs, we intercept clicks to sync the cookie
    document.addEventListener('click', function(e) {
        var logoutLink = e.target.closest('a[href*="logout"]');
        if (logoutLink) {
            clearAuthCookie();
            return;
        }

        // For all other links within the app, ensure cookie matches this tab's token before navigating
        var a = e.target.closest('a');
        if (a && a.href && (a.href.indexOf(APP_URL) !== -1 || a.href.startsWith(window.location.origin))) {
            var storedToken = sessionStorage.getItem(AUTH_TOKEN_KEY);
            if (storedToken) {
                setCookie(getCookieName(), storedToken, 8);
            }
        }
    }, true);

    // On form submit, ensure cookie is set
    document.addEventListener('submit', function(e) {
        var storedToken = sessionStorage.getItem(AUTH_TOKEN_KEY);
        if (storedToken) {
            setCookie(getCookieName(), storedToken, 8);
        }
    }, true);

    function getToken() {
        return sessionStorage.getItem(AUTH_TOKEN_KEY) || getCookie(getCookieName());
    }

    function buildApiUrl(url) {
        // Keep adding to API URLs if needed by XHR/fetch, but generally rely on cookie
        var token = getToken();
        if (!token) return url;
        try {
            var u = new URL(url, window.location.origin);
            u.searchParams.set(TOKEN_PARAM, token);
            return u.pathname + u.search + (u.hash || '');
        } catch (e) {
            var sep = url.indexOf('?') !== -1 ? '&' : '?';
            return url + sep + TOKEN_PARAM + '=' + encodeURIComponent(token);
        }
    }

    function buildPageUrl(pathOrUrl) {
        // We no longer append token to page URLs!
        return pathOrUrl;
    }

    window.SDO_BACTRACK_buildApiUrl = buildApiUrl;
    window.SDO_BACTRACK_buildPageUrl = buildPageUrl;
    window.SDO_BACTRACK_getToken = getToken;

    function init() {
        storeTokenFromUrl();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
