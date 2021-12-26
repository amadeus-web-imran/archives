<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once '../../amadeus/framework/core.php';

//cs_var('live', endsWith(__DIR__,'-live'));
cs_var('local', $local = $_SERVER['HTTP_HOST'] ==='localhost');
cs_var('mobile_app', true);

bootstrap(array(
	'name' => 'The Yield More Love Network',
	'safeName' => 'yieldmore',

	'byline' => 'Triggering Dialogue and Action',
	'footer-message' => 'To provide online resources that inspire and assist and <b>access to people who care</b>',
	'start_year' => 2013,

	'version' => [ 'id' => '008', 'date' => '11 Nov 2021' ],

	'support_page_parameters' => true, //NB: For wellbeing / happyschools etc
	'uses' => 'search1, social1, footer-message', //TODO: turn these back on
	'menu_active_class' => 'active', //TODO: 

	'theme' => 'tm-xtra',

	'styles' => ['styles', 'mobile'],
	'scripts' => ['contents'],
	'head_hooks' => [__DIR__ . '/_ga.php', __DIR__ . '/mobile-app/head.php'],
	'foot_hooks' => [__DIR__ . '/_ga.php', __DIR__ . '/mobile-app/foot.php'],

	'url' => $local ? 'http://localhost/yieldmore/www/' : 'https://yieldmore.org/',
	'path' => __DIR__,
	'no-local-stats' => true,
));

if (cs_var('mobile_app') && cs_var('node') == 'service-worker') {
	header('Content-Type: application/javascript');
	die(file_get_contents(__DIR__ . '/mobile-app/service-worker.js'));
}

function is_multisite_section($slug) {
	$fwe = cs_var('path') . '/' . $slug . '/' . cs_var('node');
	$extensions = ['.txt', '.php'];

	foreach ($extensions as $extn) {
		if (file_exists($fwe . $extn)) {
			cs_var('fwe', $fwe);
			cs_var('extn', $extn);
			cs_var('file', $fwe . $extn);
			cs_var('multisite_section', $slug);
			cs_var('home_url', $slug . '/');
			return true;
		}
	}

	return false;
}

if (is_multisite_section('services'))
	include_once 'services/_functions.php';
else
	include_once '_functions.php';


include_once 'scripts/_areas.php';

load_amadeus_module('markdown');

render();
?>
