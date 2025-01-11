// Install event: Keep this minimal, as we aren't caching assets
self.addEventListener('install', (event) => {
    console.log('Service Worker installed');
    self.skipWaiting(); // Activate the service worker immediately
});

// Activate event: Keep this minimal
self.addEventListener('activate', (event) => {
    console.log('Service Worker activated');
    return self.clients.claim(); // Take control of uncontrolled clients
});

// Fetch event: Always fetch from the network, with an offline fallback
self.addEventListener('fetch', (event) => {
    event.respondWith(
        fetch(event.request).catch(() => {
            // Serve an offline fallback page if the user is offline
            if (event.request.mode === 'navigate') {
                return caches.match('/offline.html'); // Ensure offline.html exists in your project
            }
            return new Response('You are offline.', {
                headers: { 'Content-Type': 'text/plain' }
            });
        })
    );
});
