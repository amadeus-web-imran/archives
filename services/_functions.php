<?php
cs_var('mobile_app', false);

cs_vars([
	'name' => 'Yield More Services',
	'safeName' => 'yieldmore-services',

	'byline' => 'Catalysing Growth',
	'footer-message' => 'Empowering Communities <b>with digital and media services</b>',
	'start_year' => 2019,
	'theme' => 'cv-media-agency',
	
	'social' => [
		['type' => 'facebook', 'url' => 'https://www.facebook.com/YieldMoreOrg/'],
		['type' => 'facebook', 'url' => 'https://www.facebook.com/groups/YieldMore'],
		['type' => 'twitter', 'url' => 'https://twitter.com/YieldMoreOrg'],
		['type' => 'instagram', 'url' => 'https://instagram.com/yieldmore_love'],
		['type' => 'youtube', 'url' => 'https://www.youtube.com/channel/UCESPy4vMsnv3htBqvHJh51Q'],
		['type' => 'youtube', 'url' => 'https://www.youtube.com/channel/UC_iHhVADe1oSjP3oAi5bnnw'],
		['type' => 'github', 'url' => 'https://bitbucket.org/yieldmore/www/src/master/'],
	],
	
	'contact' => [
		'heading' => 'Main Office',
		'address1' => '21/9 Ethiraj Lane, Egmore',
		'address2' => 'Chennai 600 108, India',
		'tel' => '+91-9841223313',
		'email' => 'team@yieldmore.org',
	]
]);

function before_render() { }

function did_render_page() {
	$section = cs_var('multisite_section');
	$extn = cs_var('extn');
	$file = cs_var('file');

	if ($extn == '.php')
		include_once $file;
	else
		render_txt_or_md($file);

	return true;
}
?>
