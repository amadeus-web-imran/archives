<?php $baseUrl = cs_var('url');
function data_href($section) {
    if (cs_var('node') != 'index2') return;
    echo 'data-href="'.$section.'" ';
}
 ?>
								<li class="menu-item"><a class="menu-link" href="<?php echo $baseUrl; ?>services/" <?php data_href('#section-about'); ?>><div>About</div></a></li>
								<li class="menu-item"><a class="menu-link" href="<?php echo $baseUrl; ?>services/" <?php data_href('#section-services'); ?>><div>Services</div></a></li>
								<li class="menu-item"><a class="menu-link" href="<?php echo $baseUrl; ?>amadeus/"><div>Amadeus Crafting</div></a></li>
