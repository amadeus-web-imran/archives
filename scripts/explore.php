We are #YASCOE = "Yet Another Spiritual Commune On Earth". See <a href="../marketplace/">how this "Conscious Marketplace" runs</a>

<?php
$scriptUrl = cs_var('url') . cs_var('node') . '/';

$cols = 'object';
$items = tsv_to_array(file_get_contents(__DIR__ .'/explore.tsv'), $cols);

$page = cs_var('page_parameter1');

if ($page) {
	$row = false;
	foreach ($items as $r) {
		if (urlize($r[$cols->Area]) == $page) {
			$row = $r;
			break;
		}
	}
	
	if (!$row) {
		'<h2>' . $page . ' not found</h2?';
	} else {
		echo '<h2>Area In Focus: ' . $row[$cols->Area] . '</h2>';
		echo '<p>' . $row[$cols->Introduction] . '</p>';
		if ($row[$cols->Website]) echo sprintf('<a class="btn btn-primary" href="https://%s" target="_blank">%s</a>', $row[$cols->Website], $row[$cols->Name]);
		echo sprintf('<br /><br /><a class="btn btn-secondary" href="%s">%s</a>', $scriptUrl, 'Back to Exploring #YASCOE');
		return;
	}
}

echo '<h2>Explore our Conscious Marketplace</h2><ul>';
foreach ($items as $r) {
	echo '<li><h3>' . sprintf('<a href="%s">%s</a>', $scriptUrl . urlize($r[$cols->Area]) . '/', $r[$cols->Area]) . '</h3><p>' . $r[$cols->Introduction] . '<p></li>';
}

echo '</ul>';
?>
