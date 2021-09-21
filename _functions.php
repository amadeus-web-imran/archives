<?php
//used in menu
function active_if($node) {
	$folder = false; //TODO: cs_var('safeFolder') == $node.substring(1)
	if (cs_var('node') == $node || $folder) echo ' active';
}

cs_var('sections', [
	['name' => 'Content',	'slug' => 'pages', 		'extensions' => 'txt'],
	['name' => 'Articles',	'slug' => 'authors', 	'extensions' => 'txt', 'subfolder' => true],
	['name' => 'People',	'slug' => 'people', 	'extensions' => 'txt'],
	['name' =>'Initiatives','slug' => 'initiatives','extensions' => 'txt'],
	['name' => 'Folders',	'slug' => 'downloads',	'extensions' => 'png, jpg, txt, pdf, mp3', 'content' => 'txt', 'prepend' => '', 'subfolder' => true],
	['name' => 'Resources',	'slug' => 'data', 		'extensions' => 'tsv'],
]);

function before_render() {
	if (cs_var('node') == 'go') { include_once 'resources.php'; exit; }
	$section = false;
	$file = false;
	$fol = false;

	foreach (cs_var('sections') as $s) {
		$path = cs_var('path') . '/' . $s['slug'] . '/';
		if (isset($s['subfolder'])) {
			$fol = $path . cs_var('node') . '/';
			if (is_dir($fol)) {
				cs_var('fol', $fol);
				cs_var('folName', cs_var('node'));
				$section = $s;
				break;
			} else if (is_dir($path)) {
				foreach (scandir($path) as $i) {
					if ($i == '.' || $i == '..') continue;
					$d = $path . $i . '/';
					if (is_section_file($s, $d . cs_var('node') . '.')) {
						cs_var('fol', $d);
						cs_var('folName', $i);
						$section = $s;
						break;
					}
				}
			}
		} else if (is_section_file($s, $path . cs_var('node') . '.')) {
			$section = $s;
			break;
		}
		
		if ($section) break;
	}

	cs_var('section', $section);
}

function is_section_file($s, $file) {
	foreach (explode(', ', $s['extensions']) as $extn) {
		if (file_exists($file . $extn)) {
			cs_var('file', $file = $file . $extn);
			cs_var('extn', $extn);
			return true;
		}
	}
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
	echo $nl . $nl . '<div class="row menu">' . $nl;
	$node = cs_var('node');
	
	if (cs_var('fol')) {
		echo '	<div class="col-3">' . $nl;
		echo '		<h2 class="selected">&hellip; ' . cs_var('folName') . '</h2>' . $nl;

		$last_file = '';
		foreach (scandir(cs_var('fol')) as $i) {
			$fwe = print_section_file($nl, $node, $last_file, $i);
			$last_file = $fwe;
		}
		echo '	</div>' . $nl;
	}

	foreach (cs_var('sections') as $s) {
		echo '	<div class="col-3">' . $nl;
		echo '		<h2>' . $s['name'] . '</h2>' . $nl;
		$path = cs_var('path') . '/' . $s['slug'] . '/';
		$files = scandir($path);

		$last_file = '';
		foreach ($files as $file) {
			$fwe = print_section_file($nl, $node, $last_file, $file);
			$last_file = $fwe;
		}

		echo '	</div>' . $nl;
	}

	echo '</div>' . $nl;
}

function print_section_file($nl, $node, $last_file, $file) {
	if ($file == '.' || $file == '..') return $last_file;
	$file = explode('.', $file, 2)[0];
	if ($last_file == $file) return $file;
	echo sprintf('		<a%s href="%s">%s</a>' . $nl,
		($node == $file ? ' class="selected"' : ''), cs_var('url') . $file . '/', str_replace('-', ' ', $file));
	return $file;
}

?>
