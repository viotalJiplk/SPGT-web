
self.addEventListener("install", event => {
    event.waitUntil(
        // Open a cache of resources.
        caches.open("spgt-v1").then(cache => {
            return cache.addAll([
                "/index.php",
                "/articles.php",
                "/zasedani.php",
                "/js/ajax.js",
                "/js/fillzapisy.js",
                "/js/getzapis.js"
            ]);//here should be added all css files
        })
    );
});

self.addEventListener('fetch', (event) => {
    event.respondWith(
        caches.match(event.request).then((response) => {
            return response || fetch(event.request);
        })
    );
});