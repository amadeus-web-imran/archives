<?php
//am_var('live', endsWith(__DIR__,'-live'));
am_var('local', $local = $_SERVER['HTTP_HOST'] ==='localhost');
am_var('mobile_app', true);

bootstrap([
	'name' => 'The Yield More Love Network',
	'safeName' => 'yieldmore',
	'shortName' => 'YML',

	'byline' => 'Triggering Dialogue and Action',
	'footer-message' => 'To provide online resources that inspire and assist and <b>access to people who care</b>',
	'above-footer-message' => 'We have the simple mission of connecting people, sharing ideas and creating a platform for collaboration, while promoting our own ideas and programs for celestial harmony and a new spirit of oneness.',
	'footer_post_credits' => '<br /><hr />A "for greater good" <b>[network](https://yieldmore.org)</a></b> built with a modern, elegant, [feature rich system](https://amadeusweb.com/)</b>.',
	'start_year' => 2013,

	'version' => [ 'id' => '011', 'date' => '23 Jan 2022' ],

	'support_page_parameters' => true, //NB: For wellbeing / happyschools etc
	'uses' => 'search1, social1, footer-message', //TODO: turn these back on
	'menu_active_class' => 'active', //TODO: 

	'theme' => 'biz-land', //TODO: tm-xtra
	'folder' => '/content/',

	'email' => 'team@yieldmore.org',
	'phone' => '+919841223313',
	'social' => [],

	'styles' => ['styles', 'mobile'],
	'scripts' => ['contents'],
	'head_hooks' => [SITEPATH . '/mobile-app/head.php'],
	'foot_hooks' => [SITEPATH . '/mobile-app/foot.php'],
	'social' => [
	],

	'url' => $local ? 'http://localhost/yieldmore/archives/' : 'https://archives.yieldmore.org/',
	'path' => SITEPATH,
	'no-local-stats' => true,
]);

if (am_var('mobile_app') && am_var('node') == 'service-worker') {
	header('Content-Type: application/javascript');
	die(file_get_contents(SITEPATH . '/mobile-app/service-worker.js'));
}

function is_multisite_section($slug) {
	$fwe = am_var('path') . '/' . $slug . '/' . am_var('node');
	$extensions = ['.txt', '.php'];

	foreach ($extensions as $extn) {
		if (file_exists($fwe . $extn)) {
			am_var('fwe', $fwe);
			am_var('extn', $extn);
			am_var('file', $fwe . $extn);
			am_var('multisite_section', $slug);
			am_var('multisite_path', am_var('path') . '/' . $slug);
			am_var('home_url', $slug . '/');
			return true;
		}
	}

	return false;
}

if (is_multisite_section('services'))
	include_once 'services/_functions.php';
else
	include_once 'functions.php';


include_once 'content/about/network/_areas.php';

render();
?>

