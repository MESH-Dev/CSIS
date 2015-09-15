<?php get_header(); ?>

<main id="main" class="site-main" role="main">

	<div class="container">

	<div class="three columns blog-section">
		<?php include_once(locate_template('partials/sidebar.php')); ?>
	</div>

	<div class="nine columns blog-section">

		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

			<div class="blog-content">

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

						<h2><?php the_title(); ?></h2>
						<h6><span class="postdate"><?php the_date(); ?></span> | <span class="postauthor"><?php the_author(); ?></span></h6>
						<div class="thumbnail">
							<?php
							// Must be inside a loop.

							if ( has_post_thumbnail() ) {
								the_post_thumbnail();
							}

							?>
						</div>

						<?php the_content(); ?>
						<div class="social-icons">
							<a href="https://twitter.com/home?status=I%20just%20read%20this%20article%3A%20<?php echo $link; ?>"><i class="fa fa-twitter"></i></a>
							<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $link; ?>"><i class="fa fa-facebook"></i></a>
						</div>

					</div>

				</div>

			</div>

		<?php endwhile; ?>

	</div>

	</div>

</main><!-- End of Content -->

<?php get_footer(); ?>
