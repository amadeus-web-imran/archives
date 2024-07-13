<?php
$scriptUrl = am_var('url') . am_var('node') . '/';
$scriptDataUrl = am_var('url') . am_var('section')['slug'] . '/_data/';

$cols = 'object';
$items = tsv_to_array(file_get_contents(__DIR__ .'/_data/explore.tsv'), $cols);

$page = am_var('page_parameter1');

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
		echo '<h1>Area In Focus: ' . $row[$cols->Area] . '</h1>';
		echo '<h2>Introduction</h2>';
		echo '<p>' . markdown($row[$cols->Introduction]) . '</p>';
		if ($row[$cols->Website]) echo sprintf('<a class="btn btn-primary" href="https://%s" target="_blank">%s</a>', $row[$cols->Website], $row[$cols->Name]);

		$file = __DIR__ .'/_data/' . $page;
		if (file_exists($file . '.txt')) {
			echo '<hr />';
			if (file_exists($file . '.jpg'))
				echo '<div class="banner"><img src="' . $scriptDataUrl . $page . '.jpg" class="img-fluid" /></div>';
			echo markdown(file_get_contents($file . '.txt'));
		}

		echo sprintf('<br /><br /><a class="btn btn-secondary" href="%s">%s</a>', $scriptUrl, 'Back to Exploring our Conscious Marketplace - #YASCOE');
		return;
	}
}

echo 'We are #YASCOE = "Yet Another Spiritual Commune On Earth". See <a href="../marketplace/">how this "Conscious Marketplace" runs</a>.<br /><br />';
echo '<h2>Explore our Conscious Marketplace</h2><ul>';

foreach ($items as $r) {
	echo '<li><h3>' . sprintf('<a href="%s">%s</a>', $scriptUrl . urlize($r[$cols->Area]) . '/', $r[$cols->Area]) . '</h3><p>' . markdown($r[$cols->Introduction]) . '<p></li>';
}

echo '</ul>';
?>
