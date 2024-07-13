<?php if (am_var('multisite_section')) { include_once am_var('multisite_section') . '/_footer-content.php'; return; } ?>

<div class="container">

<div class="above-footer">
<h1 class="heading">Site Overview</h1>
<?php print_sections_menu(); print_fol_menu(); ?>
<?php
echo sprintf('<div class="banner row">
	<div class="col-md-6 col-sm-12"><a href="%s"><img src="%slogo-%s-rectangle.jpg" alt="%s" class="img-fluid" /></a></div>
	<div class="col-md-6 col-sm-12">%s</div>
</div>', am_var('url'), am_var('url'), am_var('safeName'), am_var('safeName'), am_var('above-footer-message'));
//pre_banner_quote();
?>
</div>
<div class="mobile-spacer if-mobile" style="padding-bottom: 40px"></div>

</div>

