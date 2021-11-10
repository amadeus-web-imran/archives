<?php if (!cs_var('mobile_app')) return; ?>

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
	$('.if-mobile').toggleClass('show', isMobile);
	$('.if-not-mobile').toggleClass('hide', isMobile);
	if (isMobile) $('footer').hide();
}
</script>
