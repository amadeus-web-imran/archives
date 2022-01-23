<?php
cs_var('mobile_app', false);

cs_vars([
	'name' => 'YieldMore Services',
	'safeName' => 'yieldmore-services',

	'byline' => 'Growing In Harmony',
	'footer-message' => 'Empowering Communities <b>with digital and media services</b>',
	'start_year' => false,
	'theme' => 'cv-media-agency',
	
	'social' => [
		/*
		['type' => 'facebook', 'url' => 'https://www.facebook.com/YieldMoreOrg/'],
		['type' => 'facebook', 'url' => 'https://www.facebook.com/groups/YieldMore'],
		['type' => 'twitter', 'url' => 'https://twitter.com/YieldMoreOrg'],
		['type' => 'instagram', 'url' => 'https://instagram.com/yieldmore_love'],
		['type' => 'youtube', 'url' => 'https://www.youtube.com/channel/UCESPy4vMsnv3htBqvHJh51Q'],
		['type' => 'youtube', 'url' => 'https://www.youtube.com/channel/UC_iHhVADe1oSjP3oAi5bnnw'],
		*/

		['type' => 'linkedin', 'url' => 'https://www.linkedin.com/company/yieldmore-services/?viewAsMember=true'],
		['type' => 'github', 'url' => 'https://bitbucket.org/yieldmore/www/src/master/'],
	],
	
	'contact' => [
		'heading' => 'Contact',
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

function get_page_sections($page) {
	if (!($sm = cs_var('sitemap'))) {
		$cols = true;
		$rows = tsv_to_array(file_get_contents(cs_var('multisite_path') . '/page-sections.tsv'), $cols);

		$sm = new stdClass();
		$sm->columns = $cols;
		$sm->rows = $rows;

		$sm->byPage = array_group_by($rows, $cols['Page']);
		$sm->byArea = array_group_by($sm->byPage[$page], $cols['Area']);
		cs_var('sitemap', $sm);
	}

	return $sm;
}

function area_r($col, $sm) {
	echo $sm->byArea[$col][0][$sm->columns['Text']];
}

function item_r($col, $item, $sm) {
	echo $item[$sm->columns[$col]];
}

?>
