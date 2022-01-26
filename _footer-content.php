<?php if (cs_var('multisite_section')) { include_once cs_var('multisite_section') . '/_footer-content.php'; return; } ?>

<hr />

<div class="above-footer">
<h1 class="heading">Site Overview</h1>
<?php
print_sections_menu();
print_fol_menu();
echo sprintf('<div class="banner row">
	<div class="col-md-6 col-sm-12"><a href="%s"><img src="%slogo-%s-rectangle.jpg" alt="%s" class="img-fluid" /></a></div>
	<div class="col-md-6 col-sm-12">%s</div>
</div>', cs_var('url'), cs_var('url'), cs_var('safeName'), cs_var('safeName'), cs_var('above-footer-message'));
//pre_banner_quote();
?>
</div>
<div class="mobile-spacer if-mobile" style="padding-bottom: 40px"></div>
