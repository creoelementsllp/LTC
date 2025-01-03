let deferredPrompt;

// Register the service worker
if ("serviceWorker" in navigator) {
    navigator.serviceWorker
        .register("/wp-content/plugins/creo/js/sw.js")
        .then(() => {
            console.log("Service Worker Registered");
        })
        .catch((error) => {
            console.error("Service Worker Registration Failed:", error);
        });
}

// Detect if the user is on iOS
function isIOS() {
    return /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
}

// Show the install prompt for Android/Windows or iOS instructions
if (isIOS()) {
    // iOS-specific prompt: Display an instruction for adding the app to the home screen
    window.addEventListener('load', () => {
        const installPopup = document.getElementById("install-pwa-popup-ios");
        if (installPopup) {
            installPopup.style.display = "block";
        }
    });
} else {
    // For Android/Windows, use the deferred install prompt
    window.addEventListener('beforeinstallprompt', (e) => {
        // Prevent the mini-infobar from appearing on mobile
        e.preventDefault();

        // Save the event to trigger later
        deferredPrompt = e;

        // Show the install PWA popup
        const installPopup = document.getElementById("install-pwa-popup");
        if (installPopup) {
            installPopup.style.display = "block"; // Make the popup visible
        }
    });
}

// Handle the "Install" button click
document.getElementById("install-pwa-button")?.addEventListener("click", () => {
    if (deferredPrompt) {
        // Show the native install prompt for Android/Windows
        deferredPrompt.prompt();
        
        // Wait for the user's response to the prompt
        deferredPrompt.userChoice
            .then((choiceResult) => {
                if (choiceResult.outcome === "accepted") {
                    console.log("User accepted the install prompt");
                } else {
                    console.log("User dismissed the install prompt");
                }
                deferredPrompt = null; // Reset the deferred prompt
            });
        
        // Hide the popup after the user responds
        const installPopup = document.getElementById("install-pwa-popup");
        if (installPopup) {
            installPopup.style.display = "none";
        }
    }
});

// Handle the "Dismiss" button click to hide the popup
document.getElementById("dismiss-pwa-popup")?.addEventListener("click", () => {
    const installPopup = document.getElementById("install-pwa-popup");
    if (installPopup) {
        installPopup.style.display = "none"; // Hide the popup if dismissed
    }
});

// iOS specific dismiss
document.getElementById("dismiss-pwa-popup-ios")?.addEventListener("click", () => {
    const installPopup = document.getElementById("install-pwa-popup-ios");
    if (installPopup) {
        installPopup.style.display = "none"; // Hide the iOS-specific popup if dismissed
    }
});
