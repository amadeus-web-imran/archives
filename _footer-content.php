<hr />

<div class="above-footer">
<?php
print_fol_menu();
echo sprintf('<div class="banner"><a href="%s"><img src="%slogo-%s-rectangle.png" alt="%s" class="img-fluid" /></a></div>', cs_var('url'), cs_var('url'), cs_var('safeName'), cs_var('safeName'));
print_sections_menu();
//pre_banner_quote();
?>
</div>
