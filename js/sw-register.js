let deferredPrompt;

// Constants for localStorage key and max dismiss count
const DISMISS_COUNT_KEY = "pwaPopupDismissCount";
const MAX_DISMISS_COUNT = 2;

// Helper function to check dismiss count
function shouldShowPopup() {
    const dismissCount = parseInt(localStorage.getItem(DISMISS_COUNT_KEY)) || 0;
    return dismissCount < MAX_DISMISS_COUNT;
}

// Register the service worker
if ("serviceWorker" in navigator) {
    navigator.serviceWorker
        .register("/wp-content/plugins/creo/js/sw.js")
        .then(() => console.log("Service Worker Registered"))
        .catch((error) => console.error("Service Worker Registration Failed:", error));
}

// Detect if the user is on iOS
function isIOS() {
    return /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
}

// Show the install prompt for Android/Windows or iOS instructions
if (shouldShowPopup()) {
    if (isIOS()) {
        window.addEventListener("load", () => {
            const installPopup = document.getElementById("install-pwa-popup-ios");
            if (installPopup) {
                installPopup.style.display = "block";
            }
        });
    } else {
        window.addEventListener("beforeinstallprompt", (e) => {
            // Prevent the default mini-infobar from appearing
            e.preventDefault();
            deferredPrompt = e;

            // Show the install PWA popup
            const installPopup = document.getElementById("install-pwa-popup");
            if (installPopup) {
                installPopup.style.display = "block";
            }
        });
    }
}

// Handle "Install" button click for Android/Windows
document.getElementById("install-pwa-button")?.addEventListener("click", () => {
    if (deferredPrompt) {
        // Trigger the install prompt
        deferredPrompt.prompt();

        // Wait for the user's response
        deferredPrompt.userChoice.then((choiceResult) => {
            if (choiceResult.outcome === "accepted") {
                console.log("User accepted the install prompt");
            } else {
                console.log("User dismissed the install prompt");
            }
            deferredPrompt = null; // Reset the deferred prompt
        });

        // Hide the popup after interaction
        const installPopup = document.getElementById("install-pwa-popup");
        if (installPopup) {
            installPopup.style.display = "none";
        }
    }
});

// Handle dismiss button clicks to hide the popup and increment dismiss count
document.getElementById("dismiss-pwa-popup")?.addEventListener("click", () => {
    const dismissCount = parseInt(localStorage.getItem(DISMISS_COUNT_KEY)) || 0;
    localStorage.setItem(DISMISS_COUNT_KEY, dismissCount + 1);

    const installPopup = document.getElementById("install-pwa-popup");
    if (installPopup) {
        installPopup.style.display = "none";
    }
});

document.getElementById("dismiss-pwa-popup-ios")?.addEventListener("click", () => {
    const dismissCount = parseInt(localStorage.getItem(DISMISS_COUNT_KEY)) || 0;
    localStorage.setItem(DISMISS_COUNT_KEY, dismissCount + 1);

    const installPopupIOS = document.getElementById("install-pwa-popup-ios");
    if (installPopupIOS) {
        installPopupIOS.style.display = "none";
    }
});
