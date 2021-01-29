const cache = {
    "version": "1.0",
    "cache": [
        "/js/static/pwa_cache.json",
        "/index.php",
        "/",
        "/articles.php",
        "/zasedani.php",
        "/js/ajax.js",
        "/js/fillzapisy.js",
        "/js/getzapis.js",
        "/favicon.svg",
        "/images/title_background.jpg",
        "/css/main_page.css"
    ]
}  
//all css file should be added

function caching(in_json){
    // Open a cache of resources.
    caches.open("spgt-v1").then(cache => {
        return cache.addAll(in_json.cache);
    });
}
 

self.addEventListener("install", event => {
    event.waitUntil(caching(cache));
    });

self.addEventListener('fetch', (event) => {
    event.respondWith(
        caches.match(event.request).then((response) => {
            return response || fetch(event.request);
        })
    );
});