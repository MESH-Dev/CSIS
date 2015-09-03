<?php get_header(); ?>

<main id="main" class="site-main" role="main">

	<div class="container">

	<div class="three columns">
		<?php include_once(locate_template('partials/sidebar.php')); ?>
	</div>

	<div class="nine columns">

		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

			<div class="content-text">
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

				<?php the_content(); ?>
			</div>

		<?php endwhile; ?>

	</div>

	</div>

</main><!-- End of Content -->

<?php get_footer(); ?>
