<?php
//used in menu
function active_if($node) {
	$folder = false; //TODO: cs_var('safeFolder') == $node.substring(1)
	if (cs_var('node') == $node || $folder) echo ' active';
}

cs_var('sections', ['areas', 'drive', 'about', 'community']);
cs_var('long-folders', ['', 'quran','sri-aurobindo','gita', 'jesudas', 'chinmaya', 'jeevan-vidya', 'jeevan-vidya-hindi']);
//	['name' => 'C. Conception',	'slug' => 'supraja','extensions' => 'mp3, png, jpg, txt, pdf', 'subfolder' => true],
//	['name' => 'Resources',	'slug' => 'data', 		'extensions' => 'tsv'],

function section_info($id) {
	$r = ['name' => humanize($id), 'slug' => $id, 'extensions' => 'txt', 'subfolder' => true];
	if ($id == 'drive') $r['extensions'] = 'mp3, png, jpg, txt, pdf';
	if ($id == 'community') $r['extensions'] = 'txt, php';
	return $r;
}

function before_render() {
	if (cs_var('node') == 'go') { include_once 'resources.php'; exit; }
	$section = false;
	$file = false;
	$fol = false;

	foreach (cs_var('sections') as $id) {
		$s = section_info($id);
		$path = cs_var('path') . '/content/' . $s['slug'] . '/';
		if (isset($s['subfolder'])) {
			$fol = $path . cs_var('node') . '/';
			if (is_dir($fol)) {
				cs_var('fol', $fol);
				cs_var('folName', cs_var('node'));
				$section = $s;
				break;
			}

			foreach (scandir($path) as $i) {
				if ($i == '.' || $i == '..' || $i[0] == '_') continue;
				$d = $path . $i . '/';
				if (is_dir($d . cs_var('node'))) {
					cs_var('parentFol', $d);
					cs_var('parentFolName', $i);
					cs_var('fol', $d . cs_var('node') . '/');
					cs_var('folName', cs_var('node'));
					$section = $s;
					break;
				} else if (is_section_file($s, $d . cs_var('node') . '.')) {
					cs_var('parentFol', $path);
					cs_var('parentFolName', dirname($path));
					cs_var('fol', $d);
					cs_var('folName', $i);
					$section = $s;
					break;
				}

				foreach (scandir($d) as $j) {
					if ($j == '.' || $j == '..' || $j[0] == '_') continue;
					$e = $d . $j . '/';
					if (is_section_file($s, $e . cs_var('node') . '.')) {
						cs_var('parentFol', $d);
						cs_var('parentFolName', $i);
						cs_var('fol', $e);
						cs_var('folName', $j);
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
			echo '<div class="box-colour-four">';
			render_txt_or_md($about);
			echo '</div>';
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
						render_txt_or_md($file);
					}
					$done = true;
				}
			}
		} else {
			$index = cs_var('fol') . '_index.php';
			if (file_exists($index)) {
				include_once $index;
			} else if (file_exists($index = cs_var('fol') . '_index.txt')) {
				render_txt_or_md($index);
			}
		}

		echo '</div>';
		return true;
	}

	return false;
}

function site_humanize1($text) {
	if ($match = [
		'spirit' => 'A spirit of oneness to permeate the world',
		'welcome' => 'Wecome Note - circa 2021',
		'matrix' => 'Matrix of Channels and Areas',
		'sunlight' => 'Evolving Sunlight - a quality practice',
		//nom
		'brics' => 'BRiCS - Sensory Enhancement program for Children',
		'children' => 'Curation Based Education for Children',
		'classroom' => 'Classroom Suggestions and Guidelines',
		'creative-abundance' => 'Creative Abundance - Article on Perspectives',
		'creative-expression' => 'Creative Expression - 8 Week Workshop for Children',
		'education' => 'Education - Introduction for Parent and Teacher',
		'healing' => 'Healing Practices - finding Amritham or Ambrosia',
		'nom' => 'Project Nom - Wisdom Preservation Initiative',
		'nom-faqs' => 'Nom FAQs - Frequently Asked Questions',
		'nom-resources' => 'Nom Resources for Parents and Teachers',
		'pact' => 'PACT - FORUM / Resource Center for Parents and Teachers',
		'serenity' => 'Serenity - Affirmations and Healing',
		'teachers' => 'Teachers in our Network - Would you Join?',
		'words' => 'Healing Through Words (group and individual sessions)',
		//'' => '',
				]) {
		$key = urlize($text);
		if (isset($match[$key])) return $match[$key];
	}
	return $text;
}

function section_banner($section = false) {
	if ($section && in_array('jpg', explode(', ', $section['extensions']))) return;

	$fwe = (cs_var('fwe') ? cs_var('fwe') : (cs_var('node') == 'index' ? cs_var('path') . '/default.' : 'path')) . 'jpg';
	if (!file_exists($fwe)) return;

	$url = cs_var('url') . str_replace('\\', '/', substr($fwe, strlen(cs_var('path')) + 1));
	echo sprintf('<div class="banner"><img src="%s" alt="" class="img-fluid" /></div>', $url, humanize(cs_var('node')));
}

function print_fol_menu() {
	if (cs_var('fol')) print_sections_menu(true);
}

function add_to_export($slug, $level) {
	$tsvFormat = '%s	%s	%s	%s';
	$builder = $slug != 'header' ? cs_var('SitemapBuilder') : [];

	if ($slug == 'header') {
		$builder[] = sprintf($tsvFormat, '#Name', 'Level', 'Description', 'Keywords');
	} else if ($slug == 'close-file') {
		file_put_contents(cs_var('path') . '/sitemap-export.tsv', implode(PHP_EOL, $builder));
	} else {
		$builder[] = sprintf($tsvFormat, humanize($slug), $level, '', '');
	}

	cs_var('SitemapBuilder', $builder);
}

function print_sections_menu($only_fol_menu = false) {
	$sitemap = cs_var('node') == 'sitemap' && !cs_var('sitemap-called');
	$isExporting = $sitemap && cs_var('local') && isset($_GET['export']);
	$nl = cs_var('nl');
	echo $sitemap ? '<ol class="menu">' : $nl . $nl . '<div class="row menu">' . $nl;
	$node = cs_var('node');
	$empties = ['Cwsa'];
	if (cs_var('folName')) $empties[] = humanize(cs_var('folName'));

	$section = cs_var('section');
	if ($only_fol_menu) {
		echo $sitemap ? '<ol>' : '	<div class="col-12">' . $nl;
		echo $sitemap ? '' : '		<h2 class="selected">' . humanize($section['name']) . ' <i class="arrow right"></i> ' .  humanize(cs_var('folName')) . (cs_var('node') != cs_var('folName') ? ' <i class="arrow right"></i> ' . humanize(cs_var('node')) : '') . '</h2>' . $nl;

		$last_file = '';
		if (!$sitemap && cs_var('parentFol')) {
			$files = scandir(cs_var('parentFol'));
			natsort($files);
			foreach ($files as $i) {
				$fwe = print_section_file($nl, $node, $last_file, $i, $empties, $sitemap);
				if ($sitemap && $last_file != $fwe) {
					echo '</li>';
				}
				$last_file = $fwe;
			}
			echo '<hr class="menu-separator" />';
		}

		$last_file = '';
		$files = scandir(cs_var('fol'));
		natsort($files);
		foreach ($files as $i) {
			$fwe = print_section_file($nl, $node, $last_file, $i, $empties, $sitemap);
			if ($sitemap && $last_file != $fwe) {
				echo '</li>';
				if ($isExporting) add_to_export($fwe, cs_var('recursive_print_sections_menu') ? 4 : 3);

				$long = array_search($fwe, cs_var('long-folders')); //too long publications
				if (!$long && strpos($i, '.') === false)
				{
					cs_var('fol', ($orig = cs_var('fol')) . '/' . $i);
					cs_var('recursive_print_sections_menu', true);
					print_sections_menu(true);
					cs_var('recursive_print_sections_menu', false);
					cs_var('fol', $orig);
				}
			}

			$last_file = $fwe;
		}

		echo $sitemap ? '</ol>' : '	</div>' . $nl;
		echo $sitemap ? '</ol>' : '</div>' . $nl;
		return;
	}

	if ($isExporting) add_to_export('header', 0);
	foreach (cs_var('sections') as $id) {
		$s = section_info($id);
		if (($s['slug'] == 'supraja' || $s['slug'] == 'scripts') && (!$section || $section['slug'] != $s['slug'])) continue;
		echo $sitemap ? '' : '	<div class="col-md-3 col-sm-6 col-12">' . $nl;
		echo $sitemap ? '<li>' . $s['name'] . '<ol>' : '		<h2>' . $s['name'] . '</h2>' . $nl;
		$path = cs_var('path') . '/content/' . $s['slug'] . '/';
		$files = scandir($path);

		if ($isExporting) add_to_export($s['name'], 1);

		$last_file = '';
		foreach ($files as $file) {
			if (array_search($file, ['', 'zips'])) continue;
			$fwe = print_section_file($nl, $node, $last_file, $file, $empties, $sitemap);
			if (array_search($fwe, cs_var('long-folders'))) continue; //too long publications
			if ($sitemap && $last_file != $fwe && isset($s['subfolder'])) {
				cs_var('section', $s);
				cs_var('fol', $path . $file);
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
		($node == $file || cs_var('folName') == $file || cs_var('parentFolName') == $file ? ' class="selected"' : ''), cs_var('url') . $file . '/', humanize($file, $empties));
	return $file;
}
?>
