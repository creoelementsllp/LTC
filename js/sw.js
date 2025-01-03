const CACHE_NAME = 'creo-pwa-cache-v1';
const assetsToCache = [
    '/', // List of assets to cache
    '/index.html',
    '/wp-content/themes/oceanwp/style.css',
    '/offline.html',
    '/wp-content/plugins/creo/icon-192x192.png',
    '/wp-content/plugins/creo/icon-512x512.png',
    '/wp-content/plugins/creo/js/sw-register.js',
    '/wp-content/plugins/creo/assets.json',
];

// Install event: Caches essential files
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            return cache.addAll(assetsToCache);
        })
    );
});

// Fetch event: Serve cached files or fetch from network if not in cache
self.addEventListener('fetch', (event) => {
    event.respondWith(
        caches.match(event.request).then((cachedResponse) => {
            if (cachedResponse) {
                return cachedResponse;
            }
            return caches.match('/offline.html');
        })
    );
});

// Push event: Display the notification
self.addEventListener('push', (event) => {
    let title = 'New Notification';
    let options = {
        body: 'You have a new message!',
        icon: '/wp-content/plugins/creo/icon-192x192.png',
        badge: '/wp-content/plugins/creo/icon-192x192.png',
    };

    if (event.data) {
        const data = JSON.parse(event.data.text());
        title = data.title || title;
        options.body = data.body || options.body;
        options.icon = data.icon || options.icon;
    }

    event.waitUntil(
        self.registration.showNotification(title, options)
    );
});

// Notification click event
self.addEventListener('notificationclick', (event) => {
    event.notification.close();
    event.waitUntil(
        clients.openWindow('/') // Open your website or specific page when clicked
    );
});

// Activate event: Clean up old caches
self.addEventListener('activate', (event) => {
    const cacheWhitelist = [CACHE_NAME];
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames.map((cacheName) => {
                    if (!cacheWhitelist.includes(cacheName)) {
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
});
