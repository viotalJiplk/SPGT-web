
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
            ]);
        })
    );
});

// self.addEventListener('activate', (event) => {
//     var cacheKeeplist = ['spgt-v'];

//     event.waitUntil(
//       caches.keys().then((keyList) => {
//         return Promise.all(keyList.map((key) => {
//           if (cacheKeeplist.indexOf(key) === -1) {
//             return caches.delete(key);
//           }
//         }));
//       })
//     );
//   });

self.addEventListener('fetch', (event) => {
    event.respondWith(
        caches.match(event.request).then((response) => {
            return response || fetch(event.request);
        })
    );
});