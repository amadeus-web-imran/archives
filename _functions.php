<?php
//used in menu
function active_if($node) {
	$folder = false; //TODO: cs_var('safeFolder') == $node.substring(1)
	if (cs_var('node') == $node || $folder) echo ' active';
}

cs_var('sections', [
	['name' => 'Offerings',	'slug' => 'core', 		'extensions' => 'txt', 'subfolder' => true],
	['name' => 'C. Conception',	'slug' => 'supraja','extensions' => 'mp3, png, jpg, txt, pdf', 'subfolder' => true],
	['name' => 'Content',	'slug' => 'pages', 		'extensions' => 'txt'],
	['name' => 'Articles',	'slug' => 'authors', 	'extensions' => 'txt', 'subfolder' => true],
	['name' => 'People',	'slug' => 'people', 	'extensions' => 'txt'],
	['name' =>'Initiatives','slug' => 'initiatives','extensions' => 'txt'],
	['name' => 'Nuggets',	'slug' => 'downloads',	'extensions' => 'mp3, png, jpg, txt, pdf', 'subfolder' => true],
	['name' => 'Devotional',	'slug' => 'devotional',	'extensions' => 'mp3, png, jpg, txt, pdf', 'subfolder' => true],
	['name' => 'Published',	'slug' => 'published',	'extensions' => 'mp3, png, jpg, txt, pdf', 'subfolder' => true],
	//['name' => 'Resources',	'slug' => 'data', 		'extensions' => 'tsv'],
	['name' => 'Features',	'slug' => 'scripts', 	'extensions' => 'php'],
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
					if ($i == '.' || $i == '..' || $i[0] == '_') continue;
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
			cs_var('fwe', $file);
			cs_var('file', $file . $extn);
			cs_var('extn', $extn);
			return true;
		}
	}
}

function did_render_page() {
	if ($section = cs_var('section')) {
		$extn = cs_var('extn');
		$file = cs_var('file');

		$about = cs_var('fol') . '_about.txt';
		if (file_exists($about)) {
			$about = file_get_contents($about);
			echo '<div class="box-colour-2018">' . ($about && $about[0] == '#' ? markdown($about) : wpautop($about)) . '</div>';
		}

		section_banner($section);
		echo '<div id="content">';
		$done = false;
		if ($fwe = cs_var('fwe')) {
			foreach (explode(', ', $section['extensions']) as $e) {
				if (file_exists($fwe . $e)) {
					if ($done) echo '<hr />'; else echo '<h1 class="heading">' . humanize(cs_var('node')) . (cs_var('folName') ? ' - [' . humanize(cs_var('folName')) . ']' : '') . '</h1>';
					$url = cs_var('url') . str_replace('\\', '/', substr($fwe, strlen(cs_var('path')) + 1)) . $e;
					if ($e == 'pdf') {
						echo sprintf('<a href="%s" target="_blank">download :: %s.pdf</a><br /><iframe class="full-width" src="%s"></iframe>', $url, cs_var('node'), $url);
					} else if ($e == 'php') {
						include_once $fwe . 'php';
					} else if ($e == 'tsv') {
						echo 'TSV';
					} else if ($e == 'mp3') {
						echo sprintf('<audio class="full-width" width="300" height="27" preload="none" controls><source src="%s" type="audio/mp3"></audio>', $url);
					} else if ($e == 'jpg' || $e == 'png') {
						echo sprintf('<a href="%s" target="_blank"><br /><img alt="%s" class="full-width" src="%s" /></a>', $url, cs_var('node'), $url);
					} else if ($e == 'txt' && ($extn == 'txt' || file_exists($file = $fwe . $e))) {
						$raw = file_get_contents($file);
						echo $raw && $raw[0] == '#' ? markdown($raw) : wpautop($raw);
					}
					$done = true;
				}
			}
		}

		echo '</div>';
		return true;
	}

	return false;
}

function section_banner($section = false) {
	if ($section && in_array('jpg', explode(', ', $section['extensions']))) return;

	$fwe = (cs_var('fwe') ? cs_var('fwe') : cs_var('path') . '/index.') . 'jpg';
	if (!file_exists($fwe)) return;

	$url = cs_var('url') . str_replace('\\', '/', substr($fwe, strlen(cs_var('path')) + 1));
	echo sprintf('<div class="banner"><img src="%s" alt="" class="img-fluid" /></div>', $url, humanize(cs_var('node')));
}

function print_fol_menu() {
	if (cs_var('fol')) print_sections_menu(true);
}

function print_sections_menu($only_fol_menu = false) {
	$nl = cs_var('nl');
	echo $nl . $nl . '<div class="row menu">' . $nl;
	$node = cs_var('node');
	$empties = ['Cwsa'];
	if (cs_var('folName')) $empties[] = humanize(cs_var('folName'));
	
	$section = cs_var('section');
	if ($only_fol_menu) {
		echo '	<div class="col-12">' . $nl;
		echo '		<h2 class="selected">' . humanize($section['name']) . ' <i class="arrow right"></i> ' .  humanize(cs_var('folName')) . (cs_var('node') != cs_var('folName') ? ' <i class="arrow right"></i> ' . humanize(cs_var('node')) : '') . '</h2>' . $nl;

		$last_file = '';
		$files = scandir(cs_var('fol'));
		natsort($files);
		foreach ($files as $i) {
			$fwe = print_section_file($nl, $node, $last_file, $i, $empties);
			$last_file = $fwe;
		}
		echo '	</div>' . $nl;
		echo '</div>' . $nl;
		return;
	}

	foreach (cs_var('sections') as $s) {
		if ($s['slug'] == 'supraja' && (!$section || $section['slug'] != $s['slug'])) continue;
		echo '	<div class="col-md-3 col-sm-6 col-12">' . $nl;
		echo '		<h2>' . $s['name'] . '</h2>' . $nl;
		$path = cs_var('path') . '/' . $s['slug'] . '/';
		$files = scandir($path);

		$last_file = '';
		foreach ($files as $file) {
			$fwe = print_section_file($nl, $node, $last_file, $file, $empties);
			$last_file = $fwe;
		}

		echo '	</div>' . $nl;
	}

	echo '</div>' . $nl;
}

function print_section_file($nl, $node, $last_file, $file, $empties) {
	if ($file == '.' || $file == '..' || $file[0] == '_') return $last_file;
	$file = explode('.', $file, 2)[0];
	if ($last_file == $file) return $file;
	echo sprintf('		<a%s href="%s">%s</a>' . $nl,
		($node == $file || cs_var('folName') == $file ? ' class="selected"' : ''), cs_var('url') . $file . '/', humanize($file, $empties));
	return $file;
}

?>
