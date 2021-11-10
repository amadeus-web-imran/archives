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
<div class="footer-static-box if-can-use-pwa"><a href="javascript:installPWA();">Add YieldMore.org to the Home Screen</a>.</div>
<script src="<?php echo  cs_var('url'); ?>mobile-app/app-sw-wrapper.js"></script>

<div class="footer-static-box if-mobile">
	<div class="title">
		<b>The YieldMore.org Conscious Marketplace</b>
		<?php area_name(); ?>
	</div>
	<div class="area-links links-of-5"><?php area_links(); ?>
	</div>
</div>
<script>
$(document).ready(checkIfMobile);
function checkIfMobile() {
	var isMobile = <?php echo isset($_GET['mobile']) ? 'true' : 'false'; ?>;
	if (isMobile)
		$('.if-mobile').addClass('show');
	else
		$('.if-mobile').removeClass('show');
}
</script>
