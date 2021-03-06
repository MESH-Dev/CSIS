<?php /*
* Template Name: Product
*/
get_header(); ?>

<?
echo $_POST['firstname'];

 if(($_POST['firstname'] != '')&&($_POST['email'] != '')&&($_POST['lastname'] != '')){
      $submitted = true;
      echo "<script type='text/javascript'>
        jQuery(document).ready(function($){

              $('#product-email').append('Thank You! Your email has been added to our list.');
              $('.form form').hide();


        }
         </script>";


}



?>


<main id="main" class="site-main" role="main">

  <div class="container">

      <?php

      $info = false;
      $apply = false;

      if (get_field('banner') == 'image') {
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

        <section class="banner banner-inner" style="<?php if ($image) { ?> background-image: url(<?php echo $thumb; ?>); background-size: cover; background-repeat: no-repeat; background-attachment:fixed; background-position-x: center; background-position-y: center; <?php } ?>">

            <div class="banner-screen"></div>

            <div class="banner-text">
              <div class="banner-title"><?php the_title(); ?></div>
            </div>

        </section>

        <?php
      }

      elseif (get_field('banner') == 'video') {

        ?>

        <?php

          if (get_field('video_type') == 'vimeo') {
            $video = "https://player.vimeo.com/video/" . get_field('banner_video');
          } elseif (get_field('video_type') == 'youtube') {
            $video = "https://www.youtube.com/embed/" . get_field('banner_video');
          } else {
            $video = '';
          }


        ?>

        <section class="banner">

          <style>
          .embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } 
          .embed-container iframe, 
          .embed-container object, 
          .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }
          </style>

          <div class='embed-container'>
            <iframe src='<?php echo $video; ?>' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
          </div>

        </section>

        <?php

      }

      else {


      }


      ?>



      <?php

        // check if the repeater field has rows of data
        if( have_rows('sections') ):

          $n = 0;
          $side_menu = array();

         	// loop through the rows of data
            while ( have_rows('sections') ) : the_row();

              $menu_item = get_sub_field('menu_title');
              $menu_title = rtrim(strtolower($menu_item));

              $color = get_field('color');

              if ($n % 2 != 0) {
                $opp = $color;
                $color = $color . "-background";
              } else {
                $color = $color;
                $opp = $color . "-background";
              }

              $columns = "nine offset-by-three";
              $callout_columns = "seven offset-by-three";


              $menu = true;

              if (get_sub_field('image')) {

                $image = get_sub_field('image');

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

              }


              // check section type

              if ( get_sub_field('section_type') == 'intro' ) :

              ?>

              <section class="intro" id="<?php echo $menu_title;  $n; $n++; ?>" data-menu="<?php echo $menu_title; ?>">
                <div class="row">
                  <div class="nine offset-by-three columns">
                    <div class="intro-text">
                      <h2 class="<?php echo $color; ?>" ><?php echo get_sub_field('section_title'); ?></h2>
                    </div>
                  </div>
                </div>
              </section>

              <?php

              elseif ( get_sub_field('section_type') == 'body-text' ) :

              ?>

              <section class="body-text <?php echo $color; ?>" id="<?php echo $menu_title; $n; $n++; ?>" data-menu="<?php echo $menu_title; ?>">

                <div class="nine columns offset-by-three">
                  <div class="body-text-area">
                    <?php echo get_sub_field('body_text'); ?>

                    <br/>

                    <div class="six columns content-half">
                      <?php echo get_sub_field('column_1_text'); ?>
                    </div>
                    <div class="six columns content-half">
                      <?php echo get_sub_field('column_2_text'); ?>
                    </div>
                  </div>
                </div>

              </section>

              <?php

              elseif ( get_sub_field('section_type') == 'image' ) :

              ?>

              <section class="image" style="<?php if ($image) { ?> background-image: url(<?php echo $thumb; ?>); background-size: cover; background-repeat: no-repeat; background-position-y: 20%;  <?php } ?>" id="<?php echo $n; $n++; ?>" data-menu="<?php echo $menu_title; ?>">
              </section>


              <?php

              elseif ( get_sub_field('section_type') == 'video' ) :

                if (get_sub_field('video_type') == 'vimeo') {
                  $video = "https://player.vimeo.com/video/" . get_sub_field('video');
                } elseif (get_sub_field('video_type') == 'youtube') {
                  $video = "https://www.youtube.com/embed/" . get_sub_field('video');
                } else {
                  $video == '';
                }

              ?>

              <section class="video" id="<?php echo $menu_title; $n; $n++; ?>" data-menu="<?php echo $menu_title; ?>">

                <style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe src='<?php echo $video; ?>' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>

              </section>

              <?php

              elseif ( get_sub_field('section_type') == 'quote' ) :

              ?>

              <section class="<?php echo $color; ?>" id="<?php echo $menu_title; $n; $n++; ?>" data-menu="<?php echo $menu_title; ?>">

                <div class="quote">
                  <div class="nine columns offset-by-three">
                    <div class="quote-text">

                      <h3><?php echo get_sub_field('body_text'); ?></h3>

                      <div class="cta-small">
                        <div class="cta-text">
                          <?php if (get_sub_field('link_1')) { ?><a href="<?php echo get_sub_field('link_1'); ?>"><?php } ?>

                            <?php echo get_sub_field('link_text_1'); ?>

                            <span class="right"></span>

                          <?php if (get_sub_field('link_1')) { ?></a><?php } ?>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>

              </section>

              <?php

              elseif ( get_sub_field('section_type') == 'email_signup' ) :

              ?>

              <section class="email-signup" id="<?php echo $menu_title; $n; $n++;?>" data-menu="<?php echo $menu_title; ?>">
                <div class="row">
                  <div class="twelve columns">
                    <div class="intro-title"><?php echo get_sub_field('the_title'); ?></div>
                  </div>
                </div>
              </section>


              <?php

              elseif ( get_sub_field('section_type') == 'listing' ) :

              ?>

              <section class="listing <?php echo $color; ?>" id="<?php echo $menu_title; $n; $n++;?>" data-menu="<?php echo $menu_title; ?>">

                <div class="nine columns offset-by-three">

                  <div class="icons-text">

                  <?php

      							if( have_rows('listing') ): ?>

      								<?php

      								while( have_rows('listing') ): the_row();

                        $image = get_sub_field('listing_image');

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

                          <div class="icon-box four columns">
                            <p style="text-align: center;">
                              <img src="<?php echo $thumb; ?>" />
                            </p>
                            <p>
                              <h5><?php echo get_sub_field('listing_title'); ?></h5>
                            </p>
                            <p>
                              <?php echo get_sub_field('listing_body_text'); ?>
                            </p>
                          </div>

      								<?php endwhile; ?>

  					       <?php endif; //if( get_sub_field('items') ): ?>

                 </div>

              </section>

              <?php

              elseif ( get_sub_field('section_type') == 'buttons' ) :

                $apply = true;

                $n++;

              ?>

              <section class="buttons <?php echo $color; ?>" id="apply" data-menu="<?php echo $menu_title; ?>">

                <div class="<?php echo $columns; ?> columns">

                  <div class="buttons-text">
                    <?php if (get_sub_field('section_title')){ ?>
                    <h3 class="<?php echo $color; ?>"><?php echo get_sub_field('section_title'); ?></h3>
                    <?php } ?>
                    <?php if (get_sub_field('body_text')){ ?>
                    <h3 class="regular-font"><?php echo get_sub_field('body_text'); ?></h3>
                    <?php } ?>

                    <?php if (get_sub_field('link_1') != '' || get_sub_field('link_2') != ''){ ?>
                    <div class="button-wrapper">
                    <?php } ?>
                    <?php if (get_sub_field('link_1')) { ?>
                    <a href="<?php echo get_sub_field('link_1') ?>">
                      <div class="buttons-cta <?php echo $opp; ?>">
                        <?php echo get_sub_field('link_text_1') ?>
                        <span class="right"></span>
                      </div>

                    </a>
                    <?php } ?>
                    <?php if (get_sub_field('link_2')){ ?>
                    <a href="<?php echo get_sub_field('link_2') ?>">
                      <div class="buttons-cta <?php echo $opp; ?>">

                          <?php echo get_sub_field('link_text_2') ?>
                          <span class="right"></span>

                      </div>
                    </a>
                    <?php } ?>
                    <?php if (get_sub_field('link_1') != '' || get_sub_field('link_2') != ''){ ?>
                    </div>
                    <?php } ?>
                  </div>

                </div>

              </section>
            <?php

      elseif ( get_sub_field('section_type') == 'email-signup' ) :

        if (get_sub_field('pardot_url')) {
          $action = get_sub_field('pardot_url');
        } else {
          $action = '';
        }

      ?>

      <section class="email-signup yellow-primary-background" id="<?php echo $menu_title; ?>"data-menu="<?php echo $menu_title; ?>">

        <div class="email-signup-text">
          <div class="row">
            <div class="eight columns">

              <h2>Let's stay in touch.</h2>

            </div>
            <div class="four columns">
              <!-- <form id="general-email" action="http://www2.socialimpactstrategy.org/l/121292/2015-10-07/5l6dbw" method="post">
                <span class="input input--hoshi">
                  <input class="input__field input__field--hoshi" type="email" id="email" name="email" spellcheck="false" />
                  <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="email">
                    <span class="input__label-content input__label-content--hoshi">Email</span>
                  </label>
                  <input type="hidden" id="ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" />
                </span>
              </form> -->

              <iframe style="border: 0;" src="http://www2.socialimpactstrategy.org/l/121292/2015-10-08/5lq17k" width="100%" height="500" frameborder="0"></iframe>

              <div id="loader" class="hidden">
                <img src="<?php echo get_bloginfo("template_url" ); ?>/img/ajax-loader.gif" alt="">
              </div>
              <div class="email-response">

              </div>
            </div>
          </div>
        </div>

      </section>

      <?php

              elseif ( get_sub_field('section_type') == 'form' ) :

                if (get_sub_field('pardot_url')) {
                  $action = get_sub_field('pardot_url');
                } else {
                  $action = '';
                }

                $n++;

              ?>

              <section class="form <?php echo $color; ?>" id="apply" data-menu="<?php echo $menu_title; ?>">


                  <div class="row">
                    <div class="nine offset-by-three columns">

                      <div class="form-text">

                        <h3><?php echo get_sub_field('section_title'); ?></h3>
                        <h3 class="regular-font"><?php echo get_sub_field('body_text'); ?></h3>

                        <br/>

                        <!-- <?php if(!$submitted){?>
                        <form action="<?php echo $action; ?>" method="post">
                          <div class="input-box">
                            <span class="input input--hoshi">
                    					<input class="input__field input__field--hoshi" type="text" id="firstname" name="firstname" spellcheck="false" />
                    					<label class="input__label input__label--hoshi input__label--hoshi-color-1" for="first-name">
                    						<span class="input__label-content input__label-content--hoshi">First Name</span>
                    					</label>

                    				</span>
                          </div>

                          <div class="input-box">
                            <span class="input input--hoshi">
                    					<input class="input__field input__field--hoshi" type="text" id="lastname" name="lastname" spellcheck="false" />
                    					<label class="input__label input__label--hoshi input__label--hoshi-color-1" for="last-name">
                    						<span class="input__label-content input__label-content--hoshi">Last Name</span>
                    					</label>
                    				</span>
                          </div>

                          <div class="input-box">
                            <span class="input input--hoshi">
                    					<input class="input__field input__field--hoshi" type="email" id="email" name="email" spellcheck="false" />
                    					<label class="input__label input__label--hoshi input__label--hoshi-color-1" for="email">
                    						<span class="input__label-content input__label-content--hoshi">Email</span>
                    					</label>
                    				</span>
                          </div>


                          <input type="hidden" id="ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" />

                         <input type="submit" class="submit-buttons <?php echo $opp; ?>" value="Submit"></input>

                        </form>
                        <?php }?> -->

                        <?php the_sub_field('pardot_url'); ?>


                        <div id="loader" class="hidden">
                          <img src="<?php echo get_bloginfo("template_url" ); ?>/img/ajax-loader.gif" alt="">
                        </div>
                        <div id="product-email" class="email-response"></div>

                      </div>

                    </div>
                  </div>

              </section>

              <?php

              else :

              ?>

              <?php

              endif;


              array_push($side_menu, get_sub_field('menu_title'));


            endwhile;

        else :

            // no rows found

        endif; ?>



        <?php

        if ($menu == true) { ?>

          <div class="side-menu">
            <div class="list">
              <ul>
                <?php

                  $i = 0;

                  foreach($side_menu as $value) { ?>

                      <?php if(strlen($value) > 0) { ?>

                        <li><a href="#<?php echo strtolower($value); //$i// ?>"><?php echo $value; ?></a></li>

                      <?php } ?>

                    <?php

                    $i++;
                  }

                ?>
              </ul>
            </div>
            <div class="apply">
              <a href="#apply">Apply Now</a>
            </div>
          </div>

        <?php
        }

      ?>


  </div>

</main><!-- #main -->

<?php get_footer(); ?>
