<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <h1>Service worker should be enabled</h1>
    </body>

</html>
<script>
	if('serviceWorker' in navigator) {
 		 navigator.serviceWorker
           .register('sw.js')
           .then(function() { console.log('Service Worker Registered'); });
	}
</script>