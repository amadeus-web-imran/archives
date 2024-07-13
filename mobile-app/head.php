<?php if (!am_var('mobile_app')) return; ?>
<!-- manifest and service worker (for mobile app) -->
  <link rel="manifest" href="<?php echo  am_var('url'); ?>mobile-app/manifest.json" />
  <script src="<?php echo am_var('url');?>service-worker<?php echo version(); ?>"></script>
  <script src="<?php echo  am_var('url'); ?>mobile-app/app-sw-wrapper.js<?php echo version(); ?>"></script>

