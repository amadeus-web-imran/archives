//https://stackoverflow.com/a/49989382
self.addEventListener('fetch', function(event) {
	event.respondWith(async function() {
		try{
			var res = await fetch(event.request);
			var cache = await caches.open('cache');
			cache.put(event.request.url, res.clone());
			return res;
		}
		catch(error){
			return caches.match(event.request);
		}
	}());
});

self.addEventListener('sync', function(event) {
  console.log('[Service Worker] Background syncing', event);
});

self.addEventListener('notificationclick', function(event) {
  var notification = event.notification;
  var action = event.action;

  console.log(notification);
});

self.addEventListener('notificationclose', function(event) {
  console.log('Notification was closed', event);
});

self.addEventListener('push', function(event) {
  console.log('Push Notification received', event);
});
