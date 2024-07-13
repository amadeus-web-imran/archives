<?php $baseUrl = am_var('url');
function data_href($section) {
    if (am_var('node') != 'index2') return;
    echo 'data-href="'.$section.'" ';
}
 ?>
								<li class="menu-item"><a class="menu-link" href="<?php echo $baseUrl; ?>services/" <?php data_href('#section-about'); ?>><div>About YMS</div></a></li>
								<li class="menu-item"><a class="menu-link" href="<?php echo $baseUrl; ?>services/" <?php data_href('#section-services'); ?>><div>Web and IT Services</div></a></li>
								<li class="menu-item"><a class="menu-link" href="<?php echo $baseUrl; ?>amadeus/"><div>Amadeus Crafting</div></a></li>
