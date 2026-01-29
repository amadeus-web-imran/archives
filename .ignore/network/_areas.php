<?php
am_var('areas', [
	//'start' => 		['abbr' => 'ST', 'text' => 'Start Browsing Areas of Interest', 'description' => ''],
	'members' => 	['abbr' => 'HO', 'text' => 'The Yield More Love Network', 'description' => ''],
	'explore' => 	['abbr' => 'XP', 'text' => 'Explore The Community', 'description' => ''],
	//'follow' => 	['abbr' => 'FO', 'text' => 'Follow People', 'description' => ''],
	'converse' => 	['abbr' => 'CV', 'text' => 'Make Conversations', 'description' => ''],
	//'engage' => 	['abbr' => 'MP', 'text' => 'Engage With / or Buy', 'description' => ''],
]);

function area_setup() {
	$areas = am_var('areas');
	$node = am_var('node');
	if (!isset($areas[$node])) return;
	am_var('area', $areas[$node]);
}

area_setup(); //safe to call here cause including after bootstrap

function area_name() {
	$area = am_var('area');
	if (!$area) return;
	echo '<br /><em>' . $area['text'] . '</em>';
}

function area_links() {
	$a = am_var('area') ? am_var('node') : 'home';
	foreach (am_var('areas') as $slug => $area) {
		$sel = $a == $slug ? ' class="selected"' : '';
		echo PHP_EOL . '<a' . $sel . ' href="' . am_var('url') . $slug .'/">' . $area['text'] . '</a>';
	}
}

?>
