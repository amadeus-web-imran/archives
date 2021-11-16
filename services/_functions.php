<?php
cs_var('mobile_app', false);

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
