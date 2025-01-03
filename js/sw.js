const CACHE_NAME = 'creo-pwa-cache-v1';
const assetsToCache = [
    '/',
    '/index.html', // You can add more assets here that need to be cached
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
                return cachedResponse; // Serve cached content if available
            }
            
            // If no cache is found, return the offline page
            return caches.match('/offline.html');
        }).catch(() => {
            // If there’s an issue with cache or fetch, serve the offline page as a fallback
            return caches.match('/offline.html');
        })
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
                        return caches.delete(cacheName); // Delete old caches
                    }
                })
            );
        })
    );
});


self.addEventListener('push', function(event) {
    const data = event.data.json();
    self.registration.showNotification(data.title, {
        body: data.body,
        icon: data.icon || '/wp-content/plugins/creo/icon-192x192.png',
        data: data.url || '/'
    });
});

self.addEventListener('notificationclick', function(event) {
    event.notification.close();
    event.waitUntil(
        clients.openWindow(event.notification.data)
    );
});
