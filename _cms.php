<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once '../../amadeus/framework/core.php';
include_once '_functions.php';

//cs_var('live', endsWith(__DIR__,'-live'));
cs_var('local', $local = $_SERVER['HTTP_HOST'] ==='localhost');

bootstrap(array(
	'name' => 'YieldMore.org',
	'safeName' => 'yieldmore',

	'byline' => 'Triggering Dialogue and Action',
	'footer-message' => 'To provide online resources that inspire and assist and <b>access to people who care</b>',
	'start_year' => 2013,

	'version' => [
		'id' => '003',
		'date' => '13 Jun 2021',
	],

	'support_page_parameters' => true, //NB: For wellbeing / happyschools etc
	'uses' => 'search1, social1, footer-message', //TODO: turn these back on
	'menu_active_class' => 'active', //TODO: 

	//'robots' => 'noindex',
	'theme' => 'tm-xtra',

	'styles' => ['%app-assets%styles', 'styles'],
	'scripts' => ['main', 'courses', '%app-assets%ghosts', '%app-assets%blurbs'],
	'head_hooks' => [__DIR__ . '/_ga.php'],
	'url' => $local ? 'http://localhost/yieldmore/www/' : 'https://yieldmore.org/',
	'path' => __DIR__,
));

load_amadeus_module('markdown');

render();
?>
