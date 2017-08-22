<?php get_header(); ?>

<main id="content">

	<div class="container">
			<div class="three columns blog-section">

				<?php include_once(locate_template('partials/sidebar.php')); ?>

			</div>
			<div class="nine columns blog-section">
				<div class="blog-content blog-list">
					<?php $i = 0; ?>
					<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

						<?php if ($i == 0) { ?>

							<div class="twelve columns">

								<div class="blog-post">
									<div class="blog-post-categories">

											<?php
											$post_categories = wp_get_post_categories( get_the_id() );
											$cats = array();

											$first = true;

											foreach($post_categories as $c){
												$cat = get_category( $c );
												$cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug );

												if ($first) {
													echo $cat->name;
													$first = false;
												} else {
													echo ", " . $cat->name;
												}

											}

											?>

									</div>

									<h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
									<h6><span class="postdate"><?php the_time('F j, Y'); ?></span> | <span class="postauthor"><?php the_author(); ?></span></h6>
									<div class="thumbnail">
										<?php
										// Must be inside a loop.

										if ( has_post_thumbnail() ) {
											the_post_thumbnail();
										}

										?>
									</div>

									<?php the_excerpt(); ?>

									<?php

										$link = get_permalink();
										$link = str_replace(":", "%3A", $link);

									?>

									<div class="social-icons">
										<a href="https://twitter.com/home?status=I%20just%20read%20this%20article%3A%20<?php echo $link; ?>"><i class="fa fa-twitter"></i></a>
										<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $link; ?>" data-layout="link"><i class="fa fa-facebook"></i></a>
									</div>
								</div>

							</div>

						<?php } else {?>

							<div class="six columns">

								<div class="blog-post blog-post-small">
									<div class="blog-post-categories">
										<?php
										$post_categories = wp_get_post_categories( get_the_id() );
										$cats = array();

										$first = true;

										foreach($post_categories as $c){
											$cat = get_category( $c );
											$cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug );

											if ($first) {
												echo $cat->name;
												$first = false;
											} else {
												echo ", " . $cat->name;
											}

										}
										$link = get_permalink();

										?>
									</div>

									<div class="thumbnail">
										<?php
										// Must be inside a loop.

										if ( has_post_thumbnail() ) {
											the_post_thumbnail();
										}

										?>
									</div>

									<h5><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h5>
									<h6><span class="postdate"><?php the_time('F j, Y'); ?></span> | <span class="postauthor"><?php the_author(); ?></span></h6>

									<?php the_excerpt(); ?>

									<div class="social-icons">
										<a href="https://twitter.com/home?status=I%20just%20read%20this%20article%3A%20<?php echo $link; ?>"><i class="fa fa-twitter"></i></a>
										<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $link; ?>"><i class="fa fa-facebook"></i></a>
									</div>
								</div>

							</div>

						<?php } ?>

					<?php $i++; ?>
					<?php endwhile; ?>
					<?php $args = array('next_text'  => __('Load More Posts'))?>
					<div id="loadmore-posts"><?php echo paginate_links($args); ?></div>
					<div id="loader" class="hidden"><img src="<?php echo get_bloginfo("template_url" ); ?>/img/ajax-loader.gif" alt=""></div>
				</div>

			</div>
	</div>


</main><!-- End of Content -->

<?php get_footer(); ?>
