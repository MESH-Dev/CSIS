<?php /*
* Template Name: Story
*/
get_header(); ?>


<main id="main" class="site-main" role="main">

  <div class="container">

      <?php

      if (get_field('banner') == 'image') {
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

        <section class="banner banner-inner" style="<?php if ($image) { ?> background-image: url(<?php echo $thumb; ?>); background-size: cover; <?php } ?>">

            <div class="banner-screen"></div>

            <div class="banner-text">
              <div class="banner-title"><?php the_title(); ?></div>
            </div>

        </section>

        <?php
      }

      elseif (get_field('banner') == 'video') {

        ?>

        <section class="banner">

          <style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe src='https://player.vimeo.com/video/<?php echo get_field('banner_video'); ?>' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>

        </section>

        <?php

      }

      else {


      }

      // Sections

      include_once(locate_template('partials/sections.php'));

      if ($menu == true) { ?>

        <div class="side-menu">
          <ul>
            <?php

              $i = 0;

              foreach($side_menu as $value) {
                ?>

                <li><a href="#<?php echo $i; ?>"><?php echo $value; ?></a></li>

                <?php

                $i++;
              }

            ?>
          </ul>
        </div>

      <?php } ?>

  </div>

</main><!-- #main -->

<?php get_footer(); ?>
