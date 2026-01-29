<?php
$page = get_page_sections('Amadeus');
?>
		<section id="content" class="yms">
			<div class="content-wrap">

				<div id="section-amadeus" class="container-fluid page-section clearfix">

					<div class="hero-headline bottommargin">
						<h1><?php area_r('Heading', $page); ?></h1>
						<span><?php area_r('Intro', $page); ?></span>
					</div>

					<a href="#" data-scrollto="<?php area_r('ContactCTA', $page); ?>" data-easing="easeInOutExpo" data-speed="1250" data-offset="60" class="button button-dark button-black m-0">Drop us a Line</a>

					<div class="line topmargin-lg bottommargin-lg"></div>

					<div id="section-services" class="page-section">

						<h2 class="mb-5"><?php area_r('ServicesHeading', $page); ?></h2>

						<div class="row col-mb-50 mb-0"><?php foreach ($page->byArea['Services'] as $item) {?>

							<div class="col-lg-6">
								<div class="feature-box fbox-plain fbox-dark">
									<div class="fbox-icon">
										<a href="<?php item_r('Url', $item, $page); ?>"><i class="icon-et-<?php item_r('Icon', $item, $page); ?>"></i></a>
									</div>
									<div class="fbox-content">
										<h3><?php item_r('Heading', $item, $page); ?></h3>
										<p><?php item_r('Text', $item, $page); ?></p>
									</div>
								</div>
							</div><?php } ?>

							<div class="w-100 bottommargin-sm"></div>

<h2>Amadeus Web Builder - Overview</h2>

<a href="https://amadeus.yieldmore.org/showcase/" data-easing="easeInOutExpo" data-speed="1250" data-offset="60" class="button button-light m-0" target="_blank">See our Showcase</a>

<div class="video-container"><iframe src="https://docs.google.com/presentation/d/e/2PACX-1vQtVePiRBasuhrzMlVxrxxcOOivoKVj9-4ME8fTzVeuIEUgGtIR5pY_TcZPeMDkFb-D4U-K2unAANyw/embed?start=true&loop=true&delayms=3000" frameborder="0" width="960" height="569" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe></div>

(<i><a href="https://docs.google.com/presentation/d/1XEH_mxkce26oqyRPfSGh7j6xQGYgRnJdlux3xd3WjCY/edit?usp=sharing" target="_blank">view slides in google</a></i>)

						</div>

					</div>


				</div>
			</div>
		</section><!-- #content end -->
