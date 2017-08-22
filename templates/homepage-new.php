<?php /*
* Template Name: Homepage New (ca Aug17)
*/
get_header('new'); ?>

<main id="main" class="site-main seventeen-tth" role="main">

  <?php

  $image = get_field('banner_image');

  // vars
  $url = $image['url'];
  $title = $image['title'];
  $alt = $image['alt'];
  $caption = $image['caption'];

  // thumbnail
  //$size = 'large';
  $size = 'background-fullscreen';
  $thumb = $image['sizes'][ $size ];
  $width = $image['sizes'][ $size . '-width' ];
  $height = $image['sizes'][ $size . '-height' ];

  

  ?>

  <div class=""><!-- container neues -->

    <section class="banner nh has-parallax" style="<?php if ($image) { ?> background-image: url(<?php echo $thumb; ?>); background-size: cover; background-repeat: no-repeat; background-attachment:fixed; background-position-x: center; background-position-y: center;<?php } ?>">

      <div class="banner-screen"></div>
      <div class="container neues">
        <div class="seven columns" >
          <div class="banner-text" >
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
      </div>
      <!-- <div class="two columns banner-sidebar">
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
      </div> -->

    </section>
    <?php 
      $cta_msg = get_field('homepage_cta_msg');
      $cta = get_field('homepage_cta');

      if($cta != ''){
    ?>
      <section class="call-to-action">
        <div class="container neues">
         <!--  <div class="four columns"></div> -->
          <div class="row">
            <div class="four columns offset-by-four">
              <p class="title"><?php echo $cta_msg; ?></p>
            </div>
          </div>
            <h2><?php echo $cta; ?></h2>
          <!-- </div> -->
        </div>
      </section>
    <?php } ?>
    <section class="callouts">
      <div class="container neues">

  <!--     <div class="three columns">

        <div class="callout-news">

          <h3>News</h3>


          <?php

          $args = array( 'posts_per_page' => 4, 'offset'=> 1 );

          $myposts = get_posts( $args );
          foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
          <div class="callout-news-headline">
            <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
            <h6><?php the_time('F j, Y'); ?></h6>
          </div>
          <?php endforeach;
          wp_reset_postdata();?>


        </div>

      </div> -->

      <?php

        if( have_rows('homepage_callout') ): ?>

          <?php

          $i = 0;

          while( have_rows('homepage_callout') ): the_row();

            $i++;

            $color = get_sub_field('homepage_callout_color');
            //var_dump($color);
            $callout_title = get_sub_field('homepage_callout_title');
            $callout_cta = get_sub_field('homepage_callout_cta');


            $t_col='';
            $b_col='';
            if($color == 'new-red'){
              $t_col = 'new-red';
              $b_col = $t_col.'-background';
            }elseif($color == 'new-blue'){
              $t_col = 'new-blue';
              $b_col = $t_col.'-background';
            }elseif($color == 'new-purple'){
              $t_col = 'new-purple';
              $b_col = $t_col.'-background';
            }elseif($color == 'new-yellow'){
              $t_col = 'new-yellow';
              $b_col = $t_col.'-background';
            }else{
              $t_col = '';
              $b_col = '';
            }

            ?>

            <div class="four columns  hover"><!--<?php echo $color; ?>-background-->
              <div class="callout-box <?php if($i == 1 || $i % 3 == 1){echo 'alpha';}elseif($i == 2 || $i % 3 == 2){echo 'middle';} ?>" >
                <div class="callout-step"><?php if($i < 10){echo '0'.$i; }else{echo $i; }?>/ <?php echo $callout_title; ?></div>
                <div class="callout <?php if ($i % 3 == 0) { echo "omega"; } ?>">
                  <h2 class="<?php echo $t_col; ?>">
                    <!-- <a href="<?php echo get_sub_field('homepage_callout_link'); ?>"> -->
                      <?php echo $callout_cta ?>
                    <!-- </a> -->
                  </h2>
                  <?php //echo get_sub_field('homepage_callout_body_text'); ?>
                  
                </div><!-- end callout -->
                <div class="cta-small">
                    <div class="cta-text">
                      <?php if (get_sub_field('homepage_callout_link')) { ?>
                      <a class="<?php echo $t_col; ?>" href="<?php echo get_sub_field('homepage_callout_link'); ?>"><?php } ?>

                        <?php echo get_sub_field('homepage_callout_link_text'); ?> >>

                        <span class="right"></span>

                      <?php if (get_sub_field('homepage_callout_link')) { ?></a><?php } ?>
                    </div>
                  </div>
              </div>
            </div>

          <?php endwhile; ?>

       <?php endif; //if( get_sub_field('items') ): ?>
     </div>
    </section>

    <?php $bb_image = get_field('bottom_banner');
          $bb_image_url = $bb_image['sizes']['background-fullscreen'];

          if ($bb_image != ''){
    ?>
    <section class="image" aria-hidden="true" style="background-image:url('<?php echo $bb_image_url; ?>'); background-repeat:no-repeat; background-size:cover; background-position:center top; background-position:fixed;" >
    </section>
    <?php } ?>

    <!-- <section class="information">

      <div class="six columns">
        <div class="information-holder">
          <div class="information-video">

            <?php

              if (get_field('video_type') == 'vimeo') {
                $video = "https://player.vimeo.com/video/" . get_field('homepage_video');
              } elseif (get_field('video_type') == 'youtube') {
                $video = "https://www.youtube.com/embed/" . get_field('homepage_video') . "?rel=0";
              } else {
                $video == '';
              }

            ?>

            <style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe src='<?php echo $video; ?>' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
          </div>
        </div>
      </div>
      <div class="six columns">
        <div class="information-holder">
          <div class="information-network">
            <div class="information-bar">
              Global Network
            </div>

            <?php renderHomeProfileGrid(); ?>

          </div>
        </div>
      </div>

    </section> -->

  </div>

</main><!-- #main -->

<?php get_footer('new'); ?>
