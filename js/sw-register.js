let deferredPrompt;

const applicationServerKey = 'BPs19Tjb5Jc065s3CSHsy1v4aaKPLtrEyOzFZDEgb-SKwMbmA2cck3mWxljXrlWwKjYELLTc8aeYY7QwpHcxLdU'; // Replace with your public key

if ('serviceWorker' in navigator && 'PushManager' in window) {
    navigator.serviceWorker
        .register('/sw.js')
        .then(function (registration) {
            console.log('Service Worker registered:', registration);

            return registration.pushManager.getSubscription().then(async function (subscription) {
                if (!subscription) {
                    const convertedKey = urlBase64ToUint8Array(applicationServerKey);
                    return registration.pushManager.subscribe({
                        userVisibleOnly: true,
                        applicationServerKey: convertedKey,
                    });
                }
                return subscription;
            });
        })
        .then(function (subscription) {
            console.log('Push subscription:', subscription);

            // Send subscription to the server
            fetch('/wp-json/myplugin/v1/subscribe', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(subscription),
            });
        })
        .catch(function (error) {
            console.error('Service Worker error:', error);
        });
}

function urlBase64ToUint8Array(base64String) {
    const padding = '='.repeat((4 - (base64String.length % 4)) % 4);
    const base64 = (base64String + padding).replace(/-/g, '+').replace(/_/g, '/');
    const rawData = atob(base64);
    const outputArray = new Uint8Array(rawData.length);

    for (let i = 0; i < rawData.length; i++) {
        outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
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
