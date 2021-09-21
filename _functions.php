<?php
//used in menu
function active_if($node) {
	$folder = false; //TODO: cs_var('safeFolder') == $node.substring(1)
	if (cs_var('node') == $node || $folder) echo ' active';
}

cs_var('sections', [
	['name' => 'Content',	'slug' => 'pages', 		'extensions' => 'txt'],
	['name' => 'Articles',	'slug' => 'authors', 	'extensions' => 'txt', 'subfolder' => 'flat'],
	['name' => 'People',	'slug' => 'people', 	'extensions' => 'txt'],
	['name' =>'Initiatives','slug' => 'initiatives','extensions' => 'txt'],
	['name' => 'AM Drive',	'slug' => 'downloads',	'extensions' => 'pdf, mp3', 'content' => 'txt', 'prepend' => 'jpg', 'subfolder' => 'slug'],
	['name' => 'Resources',	'slug' => 'data', 		'extensions' => 'tsv'],
]);

function before_render() {
	if (cs_var('node') == 'go') { include_once 'resources.php'; exit; }
	$section = false;
	$file = false;

	foreach (cs_var('sections') as $s) {
		$path = cs_var('path') . '/' . $s['slug'] . '/';
		$file = $path . cs_var('node') . (isset($s['subfolder']) && $s['subfolder'] == 'slug' && cs_var('page_parameter1') ? '/' . cs_var('page_parameter1') : '') . '.';
		foreach (explode(', ', $s['extensions']) as $extn) {
			if (file_exists($file . $extn)) {
				cs_var('file', $file = $file . $extn);
				cs_var('extn', $extn);
				$section = $s;
				break;
			}
		}
		if ($section) break;
	}

	cs_var('section', $section);
}

function did_render_page() {
	if ($section = cs_var('section')) {
		$extn = cs_var('extn');
		$file = cs_var('file');

		section_banner($section);
		if ($extn == 'txt') {
			$raw = file_get_contents($file);
			echo $raw && $raw[0] == '#' ? markdown($raw) : wpautop($raw);
		}

		return true;
	}

	return false;
}

function section_banner($section) {
	$fol = $section ? $section['slug'] : 'assets';
	$base = cs_var('url') . '/' . $fol . '/';
	$path = cs_var('path') . '/' . $fol . '/';

	$banners = [
		cs_var('node') . '.jpg',
	];

	$banner = false;
	foreach ($banners as $b)
		if (file_exists($path . $b)) { $banner = $b; break; }

	if ($banner) echo sprintf('<img src="%s" alt="" class="img-fluid" />', $base . $banner, $section['name']);
}

function print_sections_menu() {
	$nl = cs_var('nl');
	echo '<div class="row menu">' . $nl;
	$node = cs_var('node');

	foreach (cs_var('sections') as $s) {
		echo '	<div class="col-3">' . $nl;
		echo '		<h2>' . $s['name'] . '</h2>' . $nl;
		$path = cs_var('path') . '/' . $s['slug'] . '/';
		$files = scandir($path);

		$last_file = '';
		foreach ($files as $file) {
			if ($file == '.' || $file == '..') continue;
			$file = explode('.', $file, 2)[0];
			if ($last_file == $file) continue;
			echo sprintf('		<a%s href="%s">%s</a>' . $nl,
				($node == $file ? ' class="selected"' : ''), cs_var('url') . $file . '/', str_replace('-', ' ', $file));
			$last_file = $file;
		}
		
		echo '	</div>' . $nl;
	}

	echo '</div>' . $nl;
}
?>
