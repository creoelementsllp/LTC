let deferredPrompt;
let pushSubscription = null;

// Register the service worker
if ('serviceWorker' in navigator) {
    navigator.serviceWorker
        .register('/wp-content/plugins/creo/js/sw.js')
        .then(() => {
            console.log('Service Worker Registered');
        })
        .catch((error) => {
            console.error('Service Worker Registration Failed:', error);
        });
}

// Request Push Notification permission
if ('Notification' in window && 'serviceWorker' in navigator) {
    Notification.requestPermission().then((permission) => {
        if (permission === 'granted') {
            subscribeUserToPush();
        }
    });
}

// Subscribe user for push notifications
function subscribeUserToPush() {
    navigator.serviceWorker.ready
        .then(function (registration) {
            if (!registration.pushManager) {
                alert('Push Manager unavailable');
                return;
            }

            registration.pushManager
                .subscribe({
                    userVisibleOnly: true,
                    applicationServerKey: urlBase64ToUint8Array('YOUR_PUBLIC_KEY') // Replace with your public VAPID key
                })
                .then(function (subscription) {
                    pushSubscription = subscription;
                    saveSubscription(subscription);
                })
                .catch(function (error) {
                    console.error('Push subscription failed:', error);
                });
        })
        .catch(function (error) {
            console.error('Service Worker registration failed:', error);
        });
}

// Convert the public VAPID key to a Uint8Array
function urlBase64ToUint8Array(base64String) {
    const padding = '='.repeat((4 - base64String.length % 4) % 4);
    const base64 = (base64String + padding).replace(/-/g, '+').replace(/_/g, '/');
    const rawData = window.atob(base64);
    const outputArray = new Uint8Array(rawData.length);
    for (let i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
}

// Save subscription to your server (backend logic)
function saveSubscription(subscription) {
    fetch('/wp-admin/admin-ajax.php?action=save_push_subscription', {
        method: 'POST',
        body: JSON.stringify(subscription),
        headers: {
            'Content-Type': 'application/json',
        },
    }).then((response) => {
        console.log('Subscription saved');
    });
}
