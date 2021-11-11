<?php if (!cs_var('mobile_app')) return; ?>
	<!-- manifest and service worker (for mobile app) -->
	<link rel="manifest" href="<?php echo  cs_var('url'); ?>mobile-app/manifest.json" />
	<script>var serviceWorkerUrl = "<?php echo cs_var('url');?>service-worker<?php echo version_querystring(); ?>";</script>
	<script src="<?php echo  cs_var('url'); ?>mobile-app/app-sw-wrapper.js<?php echo version_querystring(); ?>"></script>
