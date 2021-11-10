<?php if (!cs_var('mobile_app')) return; ?>

<script>
if ('serviceWorker' in navigator) {
  window.addEventListener('load', function() {
    navigator.serviceWorker.register("<?php echo  cs_var('url'); ?>service-worker").then(function(registration) {
      // Registration was successful
      console.log('ServiceWorker registration successful with scope: ', registration.scope);
    }, function(err) {
      // registration failed :(
      console.log('ServiceWorker registration failed: ', err);
    });
  });
}
</script>
<div class="footer-static-box purple loading-use-pwa" style="display1: none"><a href="javascript:installPWA();">Add YML to the Home Screen</a>.</div>
<script src="<?php echo  cs_var('url'); ?>mobile-app/app-sw-wrapper.js"></script>
