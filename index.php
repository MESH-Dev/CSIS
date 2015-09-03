<?php get_header(); ?>

<main id="content">

	<div class="container">
			<div class="three columns">

				<?php include_once(locate_template('partials/sidebar.php')); ?>

			</div>
			<div class="nine columns">
				<div class="blog-content">
					<?php $i = 0; ?>
					<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

						<?php if ($i == 0) { ?>

							<div class="twelve columns">

								<div class="blog-post">
									<div class="blog-post-categories">
										<?php
										$post_categories = wp_get_post_categories( get_the_id() );
										$cats = array();

										foreach($post_categories as $c){
											$cat = get_category( $c );
											$cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug );
											echo $cat->name;
										}

										?>
									</div>

									<h2><?php the_title(); ?></h2>
									<h6><span class="postdate"><?php the_date(); ?></span> <span class="postauthor"><?php the_author(); ?></span></h6>
									<div class="thumbnail">
										<?php
										// Must be inside a loop.

										if ( has_post_thumbnail() ) {
											the_post_thumbnail();
										}

										?>
									</div>

									<?php the_excerpt(); ?>
								</div>

							</div>

						<?php } else { ?>

							<div class="six columns">

								<div class="blog-post blog-post-small">
									<div class="blog-post-categories">
										<?php
										$post_categories = wp_get_post_categories( get_the_id() );
										$cats = array();

										foreach($post_categories as $c){
											$cat = get_category( $c );
											$cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug );
											echo $cat->name;
										}

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

									<h5><?php the_title(); ?></h5>
									<h6><span class="postdate"><?php the_date(); ?></span> <span class="postauthor"><?php the_author(); ?></span></h6>

									<?php the_excerpt(); ?>
								</div>

							</div>

						<?php } ?>

					<?php $i++; ?>
					<?php endwhile; ?>
				</div>
			</div>
	</div>


</main><!-- End of Content -->

<?php get_footer(); ?>
