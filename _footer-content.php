<hr />

<div class="above-footer">
<?php
print_fol_menu();
echo sprintf('<div class="banner"><a href="%s"><img src="%slogo-%s-rectangle.jpg" alt="%s" class="img-fluid" /></a></div>', cs_var('url'), cs_var('url'), cs_var('safeName'), cs_var('safeName'));
print_sections_menu();
//pre_banner_quote();
?>
</div>
<div class="mobile-spacer if-mobile" style="padding-bottom: 40px"></div>
