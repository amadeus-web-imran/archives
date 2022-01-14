<?php if (!cs_var('mobile_app')) return; ?>

<div class="footer-static-box if-can-use-pwa"><a href="javascript:installPWA();">Add YieldMore.org to the Home Screen</a>.</div>

<div id="mobile-footer" class="footer-static-box if-mobile">
	<div class="area-links links-of-3"><?php area_links(); ?>
	</div>
</div>

<script>
$(document).ready(checkIfMobile);
function checkIfMobile() {
	var isMobile = true; //<?php echo isset($_GET['mobile']) ? 'true' : 'false'; ?>;
	$('.if-mobile').toggleClass('show', isMobile);
	$('.if-not-mobile').toggleClass('hide', isMobile);
	if (isMobile) {
		//$('footer').hide();
		$('.mobile-spacer').css('padding-bottom', $('#mobile-footer').height());
	}
}
</script>
