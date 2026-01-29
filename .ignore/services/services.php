<?php
$theme = am_var('theme_url');
$page = get_page_sections('Services');
?>
		<!-- Content
		============================================= -->
		<section id="content" class="yms">
			<div class="content-wrap">

				<div id="section-about" class="container-fluid page-section clearfix">

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

							<div class="col-lg-7">

								<div class="accordion accordion-border clearfix">

									<div class="accordion-header">
										<div class="accordion-icon">
											<i class="accordion-closed icon-ok-circle"></i>
											<i class="accordion-open icon-remove-circle"></i>
										</div>
										<div class="accordion-title">
											Our Mission
										</div>
									</div>
									<div class="accordion-content clearfix">Our mission is to enable upto 20 forward thinking individuals, conscious businesses and spiritually tuned communities in the next two years.</div>

									<div class="accordion-header">
										<div class="accordion-icon">
											<i class="accordion-closed icon-ok-circle"></i>
											<i class="accordion-open icon-remove-circle"></i>
										</div>
										<div class="accordion-title">
											What we Do?
										</div>
									</div>
									<div class="accordion-content clearfix">Our core strengths are web development (using designs from the internet), some work with content and graphics, and a lot of programming. We prefer to train clients to manage their own web updation and to educate them on growing their social media presence.</div>

									<div class="accordion-header">
										<div class="accordion-icon">
											<i class="accordion-closed icon-ok-circle"></i>
											<i class="accordion-open icon-remove-circle"></i>
										</div>
										<div class="accordion-title">
											Our Company's Values
										</div>
									</div>
									<div class="accordion-content clearfix">We believe a bright and better world is possible, but one that we have to strive together hard to build. With a deep <a href="https://imran.yieldmore.org/impelled/for/msa/" target="_blank">sense of the spiritual</a>, Imran's writing comes from a <a href="https://imran.yieldmore.org/impelled/" target="_blank">fount of optimism and feeling</a>.</div>

								</div>

							</div>

							<div class="col-lg-5">

								<h4>Clients Say [Dummy Content].</h4>

								<div class="fslider testimonial p-0 border-0 shadow-none" data-animation="slide" data-arrows="false">
									<div class="flexslider">
										<div class="slider-wrap">
											<div class="slide">
												<div class="testi-content">
													<p>Similique fugit repellendus expedita excepturi iure perferendis provident quia eaque. Repellendus, vero numquam?</p>
													<div class="testi-meta">
														Bugs Bunny
														<span>Looney Tunes Inc.</span>
													</div>
												</div>
											</div>
											<div class="slide">
												<div class="testi-content">
													<p>Natus voluptatum enim quod necessitatibus quis expedita harum provident eos obcaecati id culpa corporis molestias.</p>
													<div class="testi-meta">
														Macon Fallon
														<span>Wild West Town-builders LLC.</span>
													</div>
												</div>
											</div>
											<div class="slide">
												<div class="testi-content">
													<p>Incidunt deleniti blanditiis quas aperiam recusandae consequatur ullam quibusdam cum libero illo rerum!</p>
													<div class="testi-meta">
														Sean Courtney
														<span>Duffy Frieght Movers</span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

							</div>

						</div>

					</div>

					<div class="line topmargin-lg bottommargin-lg"></div>

					<?php if (false) { ?><div id="section-portfolio" class="page-section">

						<h2 class="bottommargin">Portfolio.</h2>

						<!-- Portfolio Items
						============================================= -->
						<div id="portfolio" class="portfolio grid-container row gutter-20">

							<article class="portfolio-item col-12 col-sm-6 col-md-8 pf-media pf-icons wide">
								<div class="grid-inner">
									<div class="portfolio-image imagescale">
										<a href="<?php echo $theme; ?>#">
											<img src="<?php echo $theme; ?>one-page/images/portfolio/mixed/1.jpg" alt="Open Imagination">
										</a>
										<div class="bg-overlay">
											<div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-speed="400">
												<a href="<?php echo $theme; ?>#" class="text-muted h4" data-hover-animate="fadeIn" data-hover-speed="400" data-hover-animate-out="fadeOutUpSmall"><i class="icon-line-plus"></i></a>
											</div>
											<div class="bg-overlay-bg" data-hover-animate="fadeIn" data-hover-speed="400"></div>
										</div>
									</div>
									<div class="portfolio-desc">
										<h3><a href="<?php echo $theme; ?>#">Open Imagination</a></h3>
										<span><a href="<?php echo $theme; ?>#">Media</a>, <a href="<?php echo $theme; ?>#">Icons</a></span>
									</div>
								</div>
							</article>

							<article class="portfolio-item col-12 col-sm-6 col-md-4 pf-illustrations">
								<div class="grid-inner">
									<div class="portfolio-image imagescale">
										<a href="<?php echo $theme; ?>#">
											<img src="<?php echo $theme; ?>one-page/images/portfolio/mixed/2.jpg" alt="Locked Steel Gate">
										</a>
										<div class="bg-overlay">
											<div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-speed="400">
												<a href="<?php echo $theme; ?>#" class="text-muted h4" data-hover-animate="fadeIn" data-hover-speed="400" data-hover-animate-out="fadeOutUpSmall"><i class="icon-line-plus"></i></a>
											</div>
											<div class="bg-overlay-bg" data-hover-animate="fadeIn" data-hover-speed="400"></div>
										</div>
									</div>
									<div class="portfolio-desc">
										<h3><a href="<?php echo $theme; ?>#">Locked Steel Gate</a></h3>
										<span><a href="<?php echo $theme; ?>#">Illustrations</a></span>
									</div>
								</div>
							</article>

							<article class="portfolio-item col-12 col-sm-6 col-md-4 pf-graphics pf-uielements">
								<div class="grid-inner">
									<div class="portfolio-image imagescale">
										<a href="<?php echo $theme; ?>#">
											<img src="<?php echo $theme; ?>one-page/images/portfolio/mixed/3.jpg" alt="Mac Sunglasses">
										</a>
										<div class="bg-overlay">
											<div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-speed="400">
												<a href="<?php echo $theme; ?>#" class="text-muted h4" data-hover-animate="fadeIn" data-hover-speed="400" data-hover-animate-out="fadeOutUpSmall"><i class="icon-line-plus"></i></a>
											</div>
											<div class="bg-overlay-bg" data-hover-animate="fadeIn" data-hover-speed="400"></div>
										</div>
									</div>
									<div class="portfolio-desc">
										<h3><a href="<?php echo $theme; ?>#">Mac Sunglasses</a></h3>
										<span><a href="<?php echo $theme; ?>#">Graphics</a>, <a href="<?php echo $theme; ?>#">UI Elements</a></span>
									</div>
								</div>
							</article>

							<article class="portfolio-item col-12 col-sm-6 col-md-8 pf-media pf-icons wide">
								<div class="grid-inner">
									<div class="portfolio-image imagescale">
										<a href="<?php echo $theme; ?>#">
											<img src="<?php echo $theme; ?>one-page/images/portfolio/mixed/4.jpg" alt="Open Imagination">
										</a>
										<div class="bg-overlay">
											<div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-speed="400">
												<a href="<?php echo $theme; ?>#" class="text-muted h4" data-hover-animate="fadeIn" data-hover-speed="400" data-hover-animate-out="fadeOutUpSmall"><i class="icon-line-stack-2"></i></a>
											</div>
											<div class="bg-overlay-bg" data-hover-animate="fadeIn" data-hover-speed="400"></div>
										</div>
									</div>
									<div class="portfolio-desc">
										<h3><a href="<?php echo $theme; ?>#">Open Imagination</a></h3>
										<span><a href="<?php echo $theme; ?>#">Media</a>, <a href="<?php echo $theme; ?>#">Icons</a></span>
									</div>
								</div>
							</article>

							<article class="portfolio-item col-12 col-sm-6 col-md-4 pf-uielements pf-icons">
								<div class="grid-inner">
									<div class="portfolio-image imagescale">
										<a href="<?php echo $theme; ?>#">
											<img src="<?php echo $theme; ?>one-page/images/portfolio/mixed/11.jpg" alt="Backpack Contents">
										</a>
										<div class="bg-overlay">
											<div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-speed="400">
												<a href="<?php echo $theme; ?>#" class="text-muted h4" data-hover-animate="fadeIn" data-hover-speed="400" data-hover-animate-out="fadeOutUpSmall"><i class="icon-line-play"></i></a>
											</div>
											<div class="bg-overlay-bg" data-hover-animate="fadeIn" data-hover-speed="400"></div>
										</div>
									</div>
									<div class="portfolio-desc">
										<h3><a href="<?php echo $theme; ?>#">The Orange Bag</a></h3>
										<span><a href="<?php echo $theme; ?>#">Illustrations</a></span>
									</div>
								</div>
							</article>

							<article class="portfolio-item col-12 col-sm-6 col-md-4 pf-media pf-icons">
								<div class="grid-inner">
									<div class="portfolio-image imagescale">
										<a href="<?php echo $theme; ?>#">
											<img src="<?php echo $theme; ?>one-page/images/portfolio/mixed/6.jpg" alt="Open Imagination">
										</a>
										<div class="bg-overlay">
											<div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-speed="400">
												<a href="<?php echo $theme; ?>#" class="text-muted h4" data-hover-animate="fadeIn" data-hover-speed="400" data-hover-animate-out="fadeOutUpSmall"><i class="icon-line-plus"></i></a>
											</div>
											<div class="bg-overlay-bg" data-hover-animate="fadeIn" data-hover-speed="400"></div>
										</div>
									</div>
									<div class="portfolio-desc">
										<h3><a href="<?php echo $theme; ?>#">Open Imagination</a></h3>
										<span><a href="<?php echo $theme; ?>#">Media</a>, <a href="<?php echo $theme; ?>#">Icons</a></span>
									</div>
								</div>
							</article>

							<article class="portfolio-item col-12 col-sm-6 col-md-4 pf-uielements pf-icons">
								<div class="grid-inner">
									<div class="portfolio-image imagescale">
										<a href="<?php echo $theme; ?>#">
											<img src="<?php echo $theme; ?>one-page/images/portfolio/mixed/7.jpg" alt="Backpack Contents">
										</a>
										<div class="bg-overlay">
											<div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-speed="400">
												<a href="<?php echo $theme; ?>#" class="text-muted h4" data-hover-animate="fadeIn" data-hover-speed="400" data-hover-animate-out="fadeOutUpSmall"><i class="icon-line-play"></i></a>
											</div>
											<div class="bg-overlay-bg" data-hover-animate="fadeIn" data-hover-speed="400"></div>
										</div>
									</div>
									<div class="portfolio-desc">
										<h3><a href="<?php echo $theme; ?>#">Backpack Contents</a></h3>
										<span><a href="<?php echo $theme; ?>#">UI Elements</a>, <a href="<?php echo $theme; ?>#">Icons</a></span>
									</div>
								</div>
							</article>

						</div><!-- #portfolio end -->

					</div>

					<div class="line topmargin-lg bottommargin-lg"></div><?php } ?>

					<div id="section-contact" class="page-section">

					<h2 class="bottommargin">Get in Touch.</h2>

						<div class="row clearfix">

							<?php if (uses('contact')) { ?><div class="col-lg-8">

								<div class="form-widget">

									<div class="form-result"></div>

									<form class="row mb-0" id="template-contactform" name="template-contactform" action="include/form.php" method="post">

										<div class="form-process">
											<div class="css3-spinner">
												<div class="css3-spinner-scaler"></div>
											</div>
										</div>

										<div class="col-md-6 form-group">
											<input type="text" id="template-contactform-name" name="template-contactform-name" value="" class="sm-form-control border-form-control required" placeholder="Name" />
										</div>

										<div class="col-md-6 form-group">
											<input type="email" id="template-contactform-email" name="template-contactform-email" value="" class="required email sm-form-control border-form-control" placeholder="Email Address" />
										</div>

										<div class="clear"></div>

										<div class="col-12 form-group">
											<input type="text" id="template-contactform-subject" name="subject" value="" class="required sm-form-control border-form-control" placeholder="Subject" />
										</div>

										<div class="col-12 form-group">
											<textarea class="required sm-form-control border-form-control" id="template-contactform-message" name="template-contactform-message" rows="7" cols="30" placeholder="Your Message"></textarea>
										</div>

										<div class="col-12 form-group">
											<button class="button button-black ml-0 topmargin-sm" type="submit" id="template-contactform-submit" name="template-contactform-submit" value="submit">Send Message</button>
										</div>

										<div class="col-12 form-group d-none">
											<input type="text" id="template-contactform-botcheck" name="template-contactform-botcheck" value="" class="sm-form-control" />
										</div>

										<input type="hidden" name="prefix" value="template-contactform-">

									</form>

								</div>

							</div><?php } ?>

							<div class="col-lg-4">
								<h4><?php echo cs_sub_var('contact', 'heading'); ?>.</h4>

								<div style="font-size: 16px; line-height: 1.7;">
									<?php if (uses('address')) { ?><address style="line-height: 1.7;">
										<?php echo cs_sub_var('contact', 'address1'); ?><br>
										<?php echo cs_sub_var('contact', 'address2'); ?><br>
									</address>

									<div class="clear topmargin"></div><?php } ?>

									<abbr title="Phone Number"><strong>Phone:</strong></abbr> <?php echo sprintf('<a href="tel:%s">%s</a>', cs_sub_var('contact', 'tel'), cs_sub_var('contact', 'tel')); ?><br>
									<abbr title="WhatsApp"><strong>WhatsApp:</strong></abbr> <?php echo sprintf('<a href="https://wa.me/%s" target="_blank">%s</a>', str_replace('+', '', str_replace('-', '', cs_sub_var('contact', 'tel'))), cs_sub_var('contact', 'tel')); ?><br>
									<abbr title="Email Address"><strong>Email:</strong></abbr> <?php echo sprintf('<a href="mailto:%s?subject=Enquiry Reg. %s" target="_blank">%s</a>', cs_sub_var('contact', 'email'), am_var('name'), cs_sub_var('contact', 'email')); ?>
								</div>
							</div>

						</div>

					</div>

				</div>
			</div>
		</section><!-- #content end -->
