<?php /*
* Template Name: Panel
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


      ?>



      <?php

        // check if the repeater field has rows of data
        if( have_rows('sections') ):

          $n = 0;
          $side_menu = array();

         	// loop through the rows of data
            while ( have_rows('sections') ) : the_row();

              if (get_sub_field('image')) {

                $image = get_sub_field('image');

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

              } else {
                $thumb = '';
              }


              // check section type

              if ( get_sub_field('section_type') == 'intro' ) :

              ?>

              <section class="intro">
                <div class="row">
                  <div class="twelve columns">
                    <div class="intro-text">
                      <h2 class="<?php echo get_sub_field('color'); ?>" ><?php echo get_sub_field('section_title'); ?></h2>
                    </div>
                  </div>
                </div>
              </section>

              <?php

              elseif ( get_sub_field('section_type') == 'callout' ) :

              ?>

              <section class="<?php echo get_sub_field('color'); ?>-background" style="<?php if ($image) { ?> background-image: url(<?php echo $thumb; ?>); background-size: cover; <?php } ?>">

                <div class="callout-screen">

                  <div class="callout-panel">

                    <div class="ten columns">
                      <div class="callout-text">
                        <h2><?php echo get_sub_field('section_title'); ?></h2>
                        <p><?php echo get_sub_field('body_text'); ?></p>
                      </div>
                    </div>
                    <div class="two columns">
                      <?php if (get_sub_field('link_1')) { ?><a href="<?php echo get_sub_field('link_1'); ?>"><?php } ?>
                        <div class="cta-big">
                          <div class="cta-text">
                            <?php if (get_field('banner_link')) { ?><a href="<?php echo get_field('banner_link'); ?>"><?php } ?>

                              <?php echo get_field('banner_link_text'); ?>

                              <span class="right"></span>

                            <?php if (get_field('banner_link')) { ?></a><?php } ?>
                          </div>
                        </div>
                      <?php if (get_sub_field('link_1')) { ?></a><?php } ?>
                    </div>

                  </div>

                </div>

              </section>

              <?php

              elseif ( get_sub_field('section_type') == 'body-text' ) :

              ?>

              <section class="body-text" >
                <div class="row">
                  <div class="nine columns offset-by-three">
                    <div class="body-text-area">
                      <?php echo get_sub_field('body_text'); ?>
                    </div>
                  </div>
                </div>
              </section>

              <?php

              elseif ( get_sub_field('section_type') == 'image' ) :

              ?>

              <section class="image" style="<?php if ($image) { ?> background-image: url(<?php echo $thumb; ?>); background-size: cover; <?php } ?>" >
              </section>


              <?php

              elseif ( get_sub_field('section_type') == 'video' ) :

              ?>

              <section class="video" >

                <style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe src='https://player.vimeo.com/video/<?php echo get_sub_field('video'); ?>' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>

              </section>

              <?php

              elseif ( get_sub_field('section_type') == 'quote' ) :

              ?>

              <section class="<?php echo get_sub_field('color'); ?>-background" >

                <div class="quote">
                  <div class="twelve columns">
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

              <section class="email-signup" >
                <div class="row">
                  <div class="twelve columns">
                    <div class="intro-title"><?php echo get_sub_field('the_title'); ?></div>
                  </div>
                </div>
              </section>

              <?php

              elseif ( get_sub_field('section_type') == '2-column' ) :

              ?>

              <section class="listing" >


                  <?php

      							if( have_rows('2-column_callout') ): ?>

      								<?php

      								while( have_rows('2-column_callout') ): the_row();

                        if (get_sub_field('2_column_image')) {

                          $image = get_sub_field('2_column_image');

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

                        } else {
                          $thumb = '';
                        }

      									?>

      									<div class="six columns <?php echo get_sub_field('color'); ?>-background" style="<?php if ($image) { ?> background-image: url(<?php echo $thumb; ?>); background-size: cover; <?php } ?>">

                          <div class="callout-screen">

                            <div class="listing-text">
                              <h3><?php echo get_sub_field('2_column_title'); ?></h3>
                              <p><?php echo get_sub_field('2-column_body_text'); ?></p>

                              <div class="cta-small">
                                <div class="cta-text">
                                  <?php if (get_sub_field('2_column_link')) { ?><a href="<?php echo get_sub_field('2_column_link'); ?>"><?php } ?>

                                    <?php echo get_sub_field('2_column_link_text'); ?>

                                    <span class="right"></span>

                                  <?php if (get_sub_field('2_column_link')) { ?></a><?php } ?>
                                </div>
                              </div>
                            </div>

                          </div>

                        </div>

      								<?php endwhile; ?>

  					       <?php endif; //if( get_sub_field('items') ): ?>


              </section>

              <?php

              elseif ( get_sub_field('section_type') == '3-column' ) :

              ?>

              <section class="listing">

                  <?php

      							if( have_rows('3-column_callout') ): ?>

      								<?php

      								while( have_rows('3-column_callout') ): the_row();

      									?>

                        <div class="four columns <?php echo get_sub_field('color'); ?>-background">
                          <div class="listing-text">
                            <h3><?php echo get_sub_field('3-column_title'); ?></h3>
                            <p><?php echo get_sub_field('3-column_body_text'); ?></p>

                            <div class="cta-small">
                              <div class="cta-text">
                                <?php if (get_sub_field('3-column_link')) { ?><a href="<?php echo get_sub_field('3-column_link'); ?>"><?php } ?>

                                  <?php echo get_sub_field('3-column_link_text'); ?>

                                  <span class="right"></span>

                                <?php if (get_sub_field('3-column_link')) { ?></a><?php } ?>
                              </div>
                            </div>
                          </div>
                        </div>

      								<?php endwhile; ?>

  					       <?php endif; //if( get_sub_field('items') ): ?>

              </section>

              <?php

              elseif ( get_sub_field('section_type') == 'buttons' ) :

              ?>

              <section class="buttons <?php echo $color; ?>" >
                <div class="row">
                  <div class="<?php echo $columns; ?> columns">
                    <div class="buttons-title"><?php echo get_sub_field('the_title'); ?></div>
                    <div class="buttons-description"><?php echo get_sub_field('body_text'); ?></div>

                    <a href="<?php echo get_sub_field('link_1') ?>">
                      <div class="buttons-cta <?php echo $color; ?>-background">
                        <?php echo get_sub_field('link_text_1') ?>
                        <div class="callout-arrow">
                          <span class="right"></span>
                        </div>
                      </div>

                    </a>

                    <a href="<?php echo get_sub_field('link_2') ?>">
                      <div class="buttons-cta <?php echo $color; ?>-background">
                        <?php echo get_sub_field('link_text_2') ?>
                        <div class="callout-arrow">
                          <span class="right"></span>
                        </div>
                      </div>
                    </a>

                  </div>
                </div>
              </section>

              <?php

              elseif ( get_sub_field('section_type') == 'email-signup' ) :

              ?>

              <section class="email-signup yellow-primary-background" >

                <div class="email-signup-text">
                  <div class="row">
                    <div class="eight columns">

                      <h2>CTA email capture.</h2>

                    </div>
                    <div class="four columns">
                      <span class="input input--hoshi">
              					<input class="input__field input__field--hoshi" type="text" id="input-4" spellcheck="false" />
              					<label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
              						<span class="input__label-content input__label-content--hoshi">Email</span>
              					</label>
              				</span>
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

              $n++;

            endwhile;

        else :

            // no rows found

        endif;

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

        <?php
        }

      ?>


  </div>

</main><!-- #main -->

<?php get_footer(); ?>
