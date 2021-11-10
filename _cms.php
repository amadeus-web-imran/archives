<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once '../../amadeus/framework/core.php';
include_once '_functions.php';

//cs_var('live', endsWith(__DIR__,'-live'));
cs_var('local', $local = $_SERVER['HTTP_HOST'] ==='localhost');
cs_var('mobile_app', true);

bootstrap(array(
	'name' => 'YieldMore.org',
	'safeName' => 'yieldmore',

	'byline' => 'Triggering Dialogue and Action',
	'footer-message' => 'To provide online resources that inspire and assist and <b>access to people who care</b>',
	'start_year' => 2013,

	'version' => [ 'id' => '006', 'date' => '17 Oct 2021' ],

	'support_page_parameters' => true, //NB: For wellbeing / happyschools etc
	'uses' => 'search1, social1, footer-message', //TODO: turn these back on
	'menu_active_class' => 'active', //TODO: 

	'theme' => 'tm-xtra',

	'styles' => ['styles'],
	'scripts' => ['contents'],
	'head_hooks' => [__DIR__ . '/_ga.php', __DIR__ . '/mobile-app/head.php'],
	'foot_hooks' => [__DIR__ . '/_ga.php', __DIR__ . '/mobile-app/foot.php'],

	'url' => $local ? 'http://localhost/yieldmore/www/' : 'https://yieldmore.org/',
	'path' => __DIR__,
	'stats' => true,
));

if (cs_var('mobile_app') && cs_var('node') == 'service-worker')
	die(file_get_contents(__DIR__ . '/mobile-app/service-worker.js'));

load_amadeus_module('markdown');

render();
?>
