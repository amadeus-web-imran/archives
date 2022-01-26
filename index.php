<?php 
$year = isset($_GET['year']) ? $_GET['year'] : false;
section_banner(false, $year ? '/assets/years/' . $year .'.jpg' : false);
$below = '';
if ($year == '2021') $below = '&bull; a painting of [niggle](https://imran.yieldmore.org/niggle/) and [his mountains](https://legacy.yieldmore.org/niggle) by a friend Maria - <u title="Because it reinforces the needs for art in our world where we need badly to listen to our artists and their feelings their works evoke in us">why is it here?</u>';
?>
<div class="banner below"><?php echo markdown($below); ?></div>

<div id="content">
	<h1 class="heading">Welcome to YieldMore.org</h1>

<div class="row tm-row">
<?php
$articles = $year == 2021 ? [
	'about/about-us/spirit',
	'ideas/articles/imran/welcome',
	'about/about-us/matrix',
	'areas/learn/education/children',
	'areas/learn/education/education',
	'areas/learn/evolve/sunlight',
] : [
	'ideas/articles/imran/why-conscious',
	'areas/learn/educational-programs/creative-expression',
];
foreach ($articles as $item) {
	$bits = explode('/', $item);
	$slug = ($name = array_pop($bits)) . '/';
	$fol = array_pop($bits);
	$img = ($item = '/content/' . $item) . '.jpg';
	$text = excerpt($item . '.txt', $slug, '&hellip; Read More');
	?>
	<article class="col-12 col-md-6 tm-post">
		<hr class="tm-hr-primary">
		<a href="<?php echo $slug; ?>" class="effect-lily tm-post-link tm-pt-60">
			<div class="tm-post-link-inner">
				<img src="<?php echo $year ? 'assets/pages/' . $name . '.jpg' : section_banner(false, $img, true); ?>" alt="<?php echo $name; ?>" class="img-fluid">
			</div>
			<span class="position-absolute tm-new-badge"><?php echo $fol; ?></span>
			<h2 class="tm-pt-30 tm-color-primary tm-post-title"><?php echo humanize($name); ?></h2>
		</a>					
		<p class="tm-pt-30">
			<?php echo $text; ?>
		</p>
	</article>
	<?php } ?>
	</div>
</div>

