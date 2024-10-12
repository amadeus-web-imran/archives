<?php
//used in menu
function active_if($node) {
	$folder = false; //TODO: am_var('safeFolder') == $node.substring(1)
	if (am_var('node') == $node || $folder) echo ' active';
}

am_var('sections', ['areas', 'drive', 'ideas', 'about']);
am_var('long-folders', ['', 'quran','sri-aurobindo','gita', 'jesudas', 'chinmaya', 'jeevan-vidya', 'jeevan-vidya-hindi']);
//	['name' => 'C. Conception',	'slug' => 'supraja','extensions' => 'mp3, png, jpg, txt, pdf', 'subfolder' => true],
//	['name' => 'Resources',	'slug' => 'data', 		'extensions' => 'tsv'],

function before_file() {
	echo '<hr class="above-header-content" />' . am_var('nl');
	echo '<div id="content" class="content container node-' . am_var('node') . ' site-' . am_var('safeName') . '">';
	if (function_exists('site_before_file')) site_before_file();
}

function after_file() {
	if (function_exists('site_after_file')) site_after_file();
	echo '</div>';
}

function section_info($id) {
	$r = ['name' => humanize($id), 'slug' => $id, 'extensions' => 'txt', 'subfolder' => true];
	if ($id == 'drive') $r['extensions'] = 'mp3, mp4, png, jpg, txt, pdf';
	if ($id == 'about') $r['extensions'] = 'txt, png, pdf, jpg, mp3, php';
	return $r;
}

function before_render() {
	if (am_var('node') == 'go') { include_once 'resources.php'; exit; }
	$section = false;
	$file = false;
	$fol = false;

	foreach (am_var('sections') as $id) {
		$s = section_info($id);

		if (am_var('node') == $s['slug']) {
			am_var('fol', am_var('path') . '/content/'. $s['slug'] . '/');
			am_var('folName', $s['slug']);

			$s['extensions'] = 'php';
			if (is_section_file($s, am_var('path') . '/content/' . $s['slug'] . '.')) {
				$section = $s;
				break;
			}
		}

		$path = am_var('path') . '/content/' . $s['slug'] . '/';
		if (isset($s['subfolder'])) {
			$fol = $path . am_var('node') . '/';
			if (is_dir($fol)) {
				am_var('parentFolName', $s['slug']);
				am_var('fol', $fol);
				am_var('folName', am_var('node'));
				$section = $s;
				break;
			}

			foreach (scandir($path) as $i) {
				if ($i == '.' || $i == '..' || $i[0] == '_') continue;
				$d = $path . $i . '/';
				if (is_dir($d . am_var('node'))) {
					am_var('parentFol', $d);
					am_var('parentFolName', $i);
					am_var('fol', $d . am_var('node') . '/');
					am_var('folName', am_var('node'));
					$section = $s;
					break;
				} else if (is_section_file($s, $d . am_var('node') . '.')) {
					am_var('parentFol', $path);
					am_var('parentFolName', basename($path));
					am_var('fol', $d);
					am_var('folName', $i);
					$section = $s;
					break;
				}

				foreach (scandir($d) as $j) {
					if ($j == '.' || $j == '..' || $j[0] == '_') continue;
					$e = $d . $j . '/';
					if (is_section_file($s, $e . am_var('node') . '.')) {
						am_var('parentFol', $d);
						am_var('parentFolName', $i);
						am_var('fol', $e);
						am_var('folName', $j);
						$section = $s;
						break;
					}
				}
			}
		} else if (is_section_file($s, $path . am_var('node') . '.')) {
			$section = $s;
			break;
		}
		
		if ($section) break;
	}

	am_var('section', $section);
}

function is_section_file($s, $file) {
	foreach (explode(', ', $s['extensions']) as $extn) {
		if (file_exists($file . $extn)) {
			am_var('fwe', $file);
			am_var('file', $file . $extn);
			am_var('extn', $extn);
			return true;
		}
	}
}

function breadcrumb_r($var) {
	$linkFormat = '<a href="'.am_var('url').'%s">%s</a>';
	if ($var == 'home')
		return sprintf($linkFormat, '" class="home', am_var('shortName'));

	if (($slug = am_var($var)))
		return ' <i class="arrow right"></i> ' . sprintf($linkFormat, $slug . '/', humanize($slug));
}

function did_render_page() {
	if ($section = am_var('section')) {
		$extn = am_var('extn');
		$file = am_var('file');

		$isLeaf = array_search(am_var('node'), ['index', am_var('parentFolName'), am_var('folName')]) === false;
		echo '<h1 class="heading breadcrumbs">' . breadcrumb_r('home') .
			breadcrumb_r('parentFolName') .
			breadcrumb_r('folName') .
			($isLeaf ? breadcrumb_r('node') : '') .
			'</h1>';
	if (false) {
		echo '<div style="background-color: #C1FFD6; padding: 6px;">';
		am_var('subscribeSuffix', 'Also SEE: <a href="https://imran.yieldmore.org/" target=="_blank">IMRAN\'s Wrting</a>');
		include_once '../imran/code/subscribe.php';
		echo '</div>';
	}

		$about = am_var('fol') . '_about.txt';
		if (file_exists($about)) {
			echo '<div class="box-colour-four">';
			render_txt_or_md($about);
			echo '</div>';
		}

		section_banner($section);
		echo '<div id="content">';

		if ($fwe = am_var('fwe')) {
			foreach (explode(', ', $section['extensions']) as $e) {
				if (file_exists($fwe . $e)) {
					$url = am_var('url') . str_replace('\\', '/', substr($fwe, strlen(am_var('path')) + 1)) . $e;
					if ($e == 'pdf') {
						echo sprintf('<a href="%s" target="_blank">download :: %s.pdf</a><br /><iframe class="full-width" src="%s"></iframe>', $url, am_var('node'), $url);
					} else if ($e == 'php') {
						include_once $fwe . 'php';
					} else if ($e == 'tsv') {
						echo 'TSV';
					} else if ($e == 'mp3') {
						echo sprintf('<audio class="full-width" width="300" height="27" preload="none" controls><source src="%s" type="audio/mp3"></audio>', $url);
					} else if ($e == 'mp4') {
						echo sprintf('<video class="full-width" width="300" preload="none" controls><source src="%s" type="video/mp4"></video>', $url);
					} else if ($e == 'jpg' || $e == 'png') {
						echo sprintf('<a href="%s" target="_blank"><br /><img alt="%s" class="full-width" src="%s" /></a>', $url, am_var('node'), $url);
					} else if ($e == 'txt' && ($extn == 'txt' || file_exists($file = $fwe . $e))) {
						render_txt_or_md($file);
					}
				}
			}
		} else {
			$index = am_var('fol') . '_index.php';
			if (file_exists($index)) {
				include_once $index;
			} else if (file_exists($index = am_var('fol') . '_index.txt')) {
				render_txt_or_md($index);
			}
		}

		echo '</div>';
		return true;
	}

	return false;
}

function site_humanize($text) {
	if ($match = [
		'brics' => 'BRiCS',
		'see-learning' => 'SEE Learning',
		'nom' => 'Project Nom',
		'faqs' => 'FAQs',
		//'' => '',
				]) {
		$key = urlize($text);
		if (isset($match[$key])) return $match[$key];
	}
	return $text;
}

function section_banner($section = false, $fwe = false, $return = false) {
	if ($section && in_array('jpg', explode(', ', $section['extensions']))) return;

	$fwe = $fwe ? am_var('path') . $fwe
		: (am_var('fwe') ? am_var('fwe') : (am_var('node') == 'index' ? am_var('path') . '/default.' : 'path')) . 'jpg';
	if (!file_exists($fwe)) return;

	$url = am_var('url') . str_replace('\\', '/', substr($fwe, strlen(am_var('path')) + 1));
	if ($return) return $url;
	echo sprintf('<div class="banner"><img src="%s" alt="" class="img-fluid" /></div>', $url, humanize(am_var('node')));
}

function print_fol_menu() {
	if (am_var('fol')) print_sections_menu(true);
}

function get_sitemap() {
	if (!($sm = am_var('sitemap'))) {
		$cols = true;
		$rows = tsv_to_array(file_get_contents('sitemap.tsv'), $cols);

		$sm = new stdClass();
		$sm->columns = $cols;
		$sm->rows = $rows;

		$sm->byTitle = array_group_by($rows, $cols['Name']);
		am_var('sitemap', $sm);
	}

	return $sm;
}

function add_to_export($slug, $level) {
	$tsvFormat = '%s	%s	%s	%s';
	$builder = $slug != 'header' ? am_var('SitemapBuilder') : [];

	if ($slug == 'header') {
		$builder[] = sprintf($tsvFormat, '#Name', 'Level', 'Description', 'Keywords');
	} else if ($slug == 'close-file') {
		file_put_contents(am_var('path') . '/sitemap-export.tsv', implode(PHP_EOL, $builder));
	} else {
		$sitemap = get_sitemap(); //NB: cached

		$title = humanize($slug);
		$row = isset($sitemap->byTitle[$title]) ? $sitemap->byTitle[$title][0] : false;

		$description = $row ? $row[$sitemap->columns['Description']] : '';
		$keywords = $row ? $row[$sitemap->columns['Keywords']] : '';

		$builder[] = sprintf($tsvFormat, humanize($slug), $level, $description, $keywords);
	}

	am_var('SitemapBuilder', $builder);
}

function print_sections_menu($only_fol_menu = false) {
	$sitemap = am_var('node') == 'sitemap' && !am_var('sitemap-called');
	$isExporting = $sitemap && am_var('local') && isset($_GET['export']);
	$nl = am_var('nl');
	$node = am_var('node');
	$empties = ['Cwsa'];
	if (am_var('folName')) $empties[] = humanize(am_var('folName'));

	$section = am_var('section');
	if ($only_fol_menu) {
		echo $sitemap ? '' : '		<h1 class="heading">Section Menu</h1><div class="row">' . $nl;
		echo $sitemap ? '<ol>' : '<div class="section-menu col-md-6 col-sm-12"><h3>Section Folders</h3>';

		$last_file = '';
		if (!$sitemap && am_var('parentFol')) {
			$files = scandir(am_var('parentFol'));
			natsort($files);
			foreach ($files as $i) {
				$fwe = print_section_file($nl, $node, $last_file, $i, $empties, $sitemap);
				if ($sitemap && $last_file != $fwe) {
					echo '</li>';
				}
				$last_file = $fwe;
			}
			echo $sitemap ? '' : '</div><div class="section-menu col-md-6 col-sm-12 menu-separator"><h3>Folder Pages</h3>';
		}

		$last_file = '';
		$files = scandir(am_var('fol'));
		natsort($files);
		foreach ($files as $i) {
			$fwe = print_section_file($nl, $node, $last_file, $i, $empties, $sitemap);
			if ($sitemap && $last_file != $fwe) {
				echo '</li>';
				if ($isExporting) add_to_export($fwe, am_var('recursive_print_sections_menu') ? 4 : 3);

				$long = array_search($fwe, am_var('long-folders')); //too long publications
				if (!$long && strpos($i, '.') === false)
				{
					am_var('fol', ($orig = am_var('fol')) . '/' . $i);
					am_var('recursive_print_sections_menu', true);
					print_sections_menu(true);
					am_var('recursive_print_sections_menu', false);
					am_var('fol', $orig);
				}
			}

			$last_file = $fwe;
		}

		echo $sitemap ? '</ol>' : '</div>' . $nl;
		return;
	}

	echo $sitemap ? '<ol class="menu">' : $nl . $nl . '<div class="row menu">' . $nl;

	if ($isExporting) add_to_export('header', 0);
	foreach (am_var('sections') as $id) {
		$s = section_info($id);
		if (($s['slug'] == 'supraja' || $s['slug'] == 'scripts') && (!$section || $section['slug'] != $s['slug'])) continue;
		echo $sitemap ? '' : '	<div class="col-md-3 col-6">' . $nl;
		echo $sitemap ? '<li>' . $s['name'] . '<ol>' : '		<h2>' . $s['name'] . '</h2>' . $nl;
		$path = am_var('path') . '/content/' . $s['slug'] . '/';
		$files = scandir($path);

		if ($isExporting) add_to_export($s['name'], 1);

		$last_file = '';
		foreach ($files as $file) {
			if (array_search($file, ['', 'zips'])) continue;
			$fwe = print_section_file($nl, $node, $last_file, $file, $empties, $sitemap);
			if (array_search($fwe, am_var('long-folders'))) continue; //too long publications
			if ($sitemap && $last_file != $fwe && isset($s['subfolder'])) {
				am_var('section', $s);
				am_var('fol', $path . $file);
				if ($isExporting) add_to_export($file, 2);
				print_sections_menu(true);
				echo '</li>';
			}
			$last_file = $fwe;
		}

		echo $sitemap ? '</ol></li>' : '	</div>' . $nl;
	}

	echo $sitemap ? '</ol>' : '</div>' . $nl;
	if ($isExporting) add_to_export('close-file', 0);
}

function print_section_file($nl, $node, $last_file, $file, $empties, $sitemap) {
	if ($file == '.' || $file == '..' || $file[0] == '_'
		|| $file == 'assets' || $file == 'images'
		|| endsWith($file, '.xml') || endsWith($file, '.zip'))
		return $last_file;
	$file = explode('.', $file, 2)[0];
	if ($last_file == $file) return $file;
	echo sprintf(($sitemap ? '<li>' : '') . '		<a%s href="%s">%s</a>' . $nl,
		($node == $file || am_var('folName') == $file || am_var('parentFolName') == $file ? ' class="selected"' : ''), am_var('url') . $file . '/', humanize($file, $empties));
	return $file;
}
?>
