<?php
cs_var('areas', [
	'start' => 		['abbr' => 'ST', 'text' => 'Start Browsing Areas of Interest', 'description' => ''],
	'explore' => 	['abbr' => 'XP', 'text' => 'Explore The Community', 'description' => ''],
	'follow' => 	['abbr' => 'FO', 'text' => 'Follow People', 'description' => ''],
	'converse' => 	['abbr' => 'CV', 'text' => 'Make Conversations', 'description' => ''],
	'engage' => 	['abbr' => 'MP', 'text' => 'Engage With / or Buy', 'description' => ''],
]);

function area_setup() {
	$areas = cs_var('areas');
	$node = cs_var('node');
	if (!isset($areas[$node])) return;
	cs_var('area', $areas[$node]);
}

area_setup(); //safe to call here cause including after bootstrap

function area_name() {
	$area = cs_var('area');
	if (!$area) return;
	echo '<br /><em>' . $area['text'] . '</em>';
}

function area_links() {
	$a = cs_var('area') ? cs_var('node') : false;
	foreach (cs_var('areas') as $slug => $area) {
		$sel = $a == $slug ? ' class="selected"' : '';
		echo PHP_EOL . '<a' . $sel . ' href="' . cs_var('url') . $slug .'/?mobile=1">' . $area['abbr'] . '</a>';
	}
}

?>