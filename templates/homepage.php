<?php /*
* Template Name: Homepage
*/
get_header(); ?>

<main id="main" class="site-main" role="main">

  <?php

  $image = get_field('banner_image');

  // vars
  $url = $image['url'];
  $title = $image['title'];
  $alt = $image['alt'];
  $caption = $image['caption'];

  // thumbnail
  $size = 'large';
  $thumb = $image['sizes'][ $size ];
  $width = $image['sizes'][ $size . '-width' ];
  $height = $image['sizes'][ $size . '-height' ];

  ?>

  <div class="container">

    <section class="banner" style="<?php if ($image) { ?> background-image: url(<?php echo $thumb; ?>); background-size: cover; <?php } ?>">

      <div class="banner-screen"></div>

      <div class="ten columns" >
        <div class="banner-text">
          <div class="banner-title"><?php echo get_field('title'); ?></div>
          <div class="cta-small">

            <div class="cta-text">
              <?php if (get_field('banner_link')) { ?><a href="<?php echo get_field('banner_link'); ?>"><?php } ?>

                <?php echo get_field('banner_link_text'); ?>

                <span class="right"></span>

              <?php if (get_field('banner_link')) { ?></a><?php } ?>
            </div>

          </div>
        </div>
      </div>
      <div class="two columns banner-sidebar">
        <nav class="banner-navigation">
					<?php if(has_nav_menu('banner_nav')){
								$defaults = array(
									'theme_location'  => 'banner_nav',
									'menu'            => 'banner_nav',
									'container'       => false,
									'container_class' => '',
									'container_id'    => '',
									'menu_class'      => 'menu',
									'menu_id'         => '',
									'echo'            => true,
									'fallback_cb'     => 'wp_page_menu',
									'before'          => '',
									'after'           => '',
									'link_before'     => '',
									'link_after'      => '',
									'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
									'depth'           => 0,
									'walker'          => ''
								); wp_nav_menu( $defaults );
							}else{
								echo "<p><em>main_nav</em> doesn't exist! Create it and it'll render here.</p>";
							} ?>
				</nav>
      </div>

    </section>

    <section class="news">

      <div class="three columns">

        <div class="callout-news">

          <h3>News</h3>

          <div class="callout-news-headline">
            <h5>Headline One Goes Here Up to Three Lines</h5>
            <h6>Jan 13, 2015</h6>
          </div>
          <div class="callout-news-headline">
            <h5>Headline One Goes Here Up to Three Lines</h5>
            <h6>Jan 13, 2015</h6>
          </div>
          <div class="callout-news-headline">
            <h5>Headline One Goes Here Up to Three Lines</h5>
            <h6>Jan 13, 2015</h6>
          </div>


        </div>

      </div>

      <?php

        if( have_rows('homepage_callout') ): ?>

          <?php

          $i = 0;

          while( have_rows('homepage_callout') ): the_row();

            $i++;

            $color = get_sub_field('homepage_callout_color');

            ?>

            <div class="three columns <?php echo $color; ?>-background">
              <div class="callout <?php if ($i % 3 == 0) { echo "omega"; } ?>">
                <h3><a href="<?php echo get_sub_field('homepage_callout_link'); ?>"><?php echo get_sub_field('homepage_callout_title'); ?></a></h3>
                <?php echo get_sub_field('homepage_callout_body_text'); ?>
                <div class="cta-small">
                  <div class="cta-text">
                    <?php if (get_sub_field('homepage_callout_link')) { ?><a href="<?php echo get_sub_field('homepage_callout_link'); ?>"><?php } ?>

                      <?php echo get_sub_field('homepage_callout_link_text'); ?>

                      <span class="right"></span>

                    <?php if (get_sub_field('homepage_callout_link')) { ?></a><?php } ?>
                  </div>
                </div>
              </div>
            </div>

          <?php endwhile; ?>

       <?php endif; //if( get_sub_field('items') ): ?>

    </section>

    <section class="information">

      <div class="six columns information-video">
        <style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe src='https://player.vimeo.com/video/<?php echo get_field('homepage_video'); ?>' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
      </div>
      <div class="six columns information-network">
        <div class="information-bar">
          Global Network
        </div>

        <?php for($x = 0; $x < 8; $x++) { ?>
          <div class="person">
            <img src="<?php echo get_template_directory_uri(); ?>/img/portrait.jpg" />
          </div>
        <?php } ?>

      </div>

    </section>

  </div>

</main><!-- #main -->

<?php get_footer(); ?>
