<?php
$to = cs_var('page_parameter1') ? cs_var('page_parameter1') : false;

$links = [
	'ppt' => 'https://docs.google.com/presentation/d/15HUt-gC3SjTaiASujJcLCnqyeVMr5_PyAD8GJ1QoppY/edit?usp=sharing|Main YM Presentation',
	'spotify' => 'https://open.spotify.com/user/315lvkcpusfoibsyecvo45qb3cnm?si=e8dbc11e9c634fff|YM Spotify Playlists',
	'stories' => 'https://docs.google.com/spreadsheets/d/1GW1ebEMLQWMlFHzmzpeh5pv1sl0x4018u0NbU-3o3ZE/edit?usp=sharing|YM Themes in Movies',
	'mentoring-invite' => 'https://docs.google.com/document/d/1pruNDGoLXnrN9pK9dTtJGwxCTLTga-VHvd-BFefrcpI/edit?usp=sharing|Nom Mentoring Invitation for Yougsters',
	'cwc' => 'https://www.facebook.com/groups/condolenceswithconcern/',
];

$go = cs_var('node') == 'go';

if ($to == 'share') {
	$for = $url = $_SERVER['REQUEST_SCHEME'] . '://' . $_GET['url'];
	$url .= '?utm_source=%source%';
	$url .= isset($_GET['campaign']) ? '&utm_campaign=' . $_GET['campaign'] : '';
	$url .= isset($_GET['by']) ? '&utm_content=referred-by-' . strtolower($_GET['by']) : '';
	$sources = ['whatsapp', 'facebook', 'email', 'linkedin'];
	echo '<style type="text/css"> body { font-size: 250% } </style>';
	echo '<u>Copy Link and Share</u>:<br /><br />' . $for . '<br />';
	foreach ($sources as $source) echo sprintf('<a href="%s">%s</a> | ', str_replace('%source%', $source, $url), $source);
	return;
}

if ($go && $to && isset($links[$to])) {
	$link = explode('|', $links[$to])[0];
	header('Location: ' . $link);
	return;
}

if ($go) { echo 'No GO link defined, pls visit <a href="../resources/">our resources page</a>.'; return; }

echo '<ol>';
foreach ($links as $slug=>$url_name) {
	$bits = explode('|', $url_name);
	echo sprintf('<li><a href="%s" target="_blank" title="%s">%s</a></li>', cs_var('url') . 'go/' . $slug . '/', $bits[0], $bits[1]);
}
echo '</ol>';
?>

