var deferredPrompt;

if (!window.Promise) {
  window.Promise = Promise;
}

//https://petelepage.com/blog/2019/07/is-my-pwa-installed/
window.canMakePWA = false;

function showOrHideCanMakePWA() {
	if (window.canMakePWA)
		$('.if-can-use-pwa').addClass('show');
	else
		$('.if-can-use-pwa').removeClass('show');
}

if ('serviceWorker' in navigator) {
	navigator.serviceWorker
		.register('../service-worker')
		.then(function () {
			console.log('ServiceWorker registration successful with scope: ', registration.scope);
		})
		.catch(function(err) {
			console.log('ServiceWorker registration failed: ', err);
		});
}

window.addEventListener('beforeinstallprompt', function(event) {
	console.log('beforeinstallprompt fired');
	event.preventDefault();
	deferredPrompt = event;
	window.canMakePWA = true;
	showOrHideCanMakePWA();
	return false;
});

function installPWA() {
	if (!deferredPrompt) return;

	deferredPrompt.prompt();
	deferredPrompt.userChoice.then(function (choiceResult) {
		console.log(choiceResult.outcome);
	
		if (choiceResult.outcome === 'dismissed') {
			console.log('User cancelled installation');
		} else {
			console.log('User added to home screen');
		}
	});
	deferredPrompt = null;
	window.canMakePWA = false;
	showOrHideCanMakePWA();
}

/*
function askForNotificationPermission() {
  Notification.requestPermission(function(result) {
    console.log('User Choice', result);
    if (result !== 'granted') {
      console.log('No notification permission granted!');
    } else {
      // configurePushSub();
      // displayConfirmNotification();
    }
  });
}

if ('Notification' in window && 'serviceWorker' in navigator) {
  for (var i = 0; i < enableNotificationsButtons.length; i++) {
    enableNotificationsButtons[i].style.display = 'inline-block';
    enableNotificationsButtons[i].addEventListener('click', askForNotificationPermission);
  }
}
*/
