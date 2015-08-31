<?php /*
* Template Name: Product
*/
get_header(); ?>


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
                $size = 'large';
                $thumb = $image['sizes'][ $size ];
                $width = $image['sizes'][ $size . '-width' ];
                $height = $image['sizes'][ $size . '-height' ];

              }


              // check section type

              if ( get_sub_field('section_type') == 'intro' ) :

              ?>

              <section class="intro">
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

              <section class="body-text <?php echo $color; ?>" id="<?php echo $n; ?>">

                <div class="nine columns offset-by-three">
                  <div class="body-text-area">
                    <?php echo get_sub_field('body_text'); ?>
                  </div>
                </div>

              </section>

              <?php

              elseif ( get_sub_field('section_type') == 'image' ) :

              ?>

              <section class="image" style="<?php if ($image) { ?> background-image: url(<?php echo $thumb; ?>); background-size: cover; <?php } ?>" id="<?php echo $n; ?>">
              </section>


              <?php

              elseif ( get_sub_field('section_type') == 'video' ) :

              ?>

              <section class="video" id="<?php echo $n; ?>">

                <style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe src='https://player.vimeo.com/video/<?php echo get_sub_field('video'); ?>' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>

              </section>

              <?php

              elseif ( get_sub_field('section_type') == 'quote' ) :

              ?>

              <section class="<?php echo $color; ?>" >

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

              <section class="email-signup" id="<?php echo $n; ?>">
                <div class="row">
                  <div class="twelve columns">
                    <div class="intro-title"><?php echo get_sub_field('the_title'); ?></div>
                  </div>
                </div>
              </section>


              <?php

              elseif ( get_sub_field('section_type') == 'listing' ) :

              ?>

              <section class="listing <?php echo $color; ?>" id="<?php echo $n; ?>">

                <div class="nine columns offset-by-three">

                  <div class="icons-text">

                  <?php

      							if( have_rows('listing') ): ?>

      								<?php

      								while( have_rows('listing') ): the_row();

      									?>

                          <div class="icon-box">
                            <p style="text-align: center;">
                              <img src="<?php echo get_template_directory_uri(); ?>/img/icon.png" />
                            </p>
                            <p>
                              <strong>Skill Gain One</strong>
                            </p>
                            <p>
                              This is sample text or typography for this space right here.
                            </p>
                          </div>

      								<?php endwhile; ?>

  					       <?php endif; //if( get_sub_field('items') ): ?>

                 </div>

              </section>

              <?php

              elseif ( get_sub_field('section_type') == 'buttons' ) :

                $apply = true;

              ?>

              <section class="buttons <?php echo $color; ?>" id="apply">

                <div class="<?php echo $columns; ?> columns">

                  <div class="buttons-text">
                    <h3 class="<?php echo $color; ?>"><?php echo get_sub_field('section_title'); ?></h3>
                    <h3 class="regular-font"><?php echo get_sub_field('body_text'); ?></h3>

                    <a href="<?php echo get_sub_field('link_1') ?>">
                      <div class="buttons-cta <?php echo $opp; ?>">
                        <?php echo get_sub_field('link_text_1') ?>

                      </div>

                    </a>

                    <a href="<?php echo get_sub_field('link_2') ?>">
                      <div class="buttons-cta <?php echo $opp; ?>">
                        <?php echo get_sub_field('link_text_2') ?>

                      </div>
                    </a>

                  </div>

                </div>

              </section>

              <?php

              elseif ( get_sub_field('section_type') == 'form' ) :

              ?>

              <section class="form <?php echo $color; ?>" id="info">


                  <div class="row">
                    <div class="nine offset-by-three columns">

                      <div class="form-text">

                        <h3><?php echo get_sub_field('section_title'); ?></h3>
                        <h3 class="regular-font"><?php echo get_sub_field('body_text'); ?></h3>

                        <br/>

                        <div class="input-box">
                          <span class="input input--hoshi">
                  					<input class="input__field input__field--hoshi" type="text" id="input-4" spellcheck="false" />
                  					<label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                  						<span class="input__label-content input__label-content--hoshi">First Name</span>
                  					</label>
                  				</span>
                        </div>

                        <div class="input-box">
                          <span class="input input--hoshi">
                  					<input class="input__field input__field--hoshi" type="text" id="input-4" spellcheck="false" />
                  					<label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                  						<span class="input__label-content input__label-content--hoshi">Last Name</span>
                  					</label>
                  				</span>
                        </div>

                        <div class="input-box">
                          <span class="input input--hoshi">
                  					<input class="input__field input__field--hoshi" type="text" id="input-4" spellcheck="false" />
                  					<label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                  						<span class="input__label-content input__label-content--hoshi">Email</span>
                  					</label>
                  				</span>
                        </div>

                        <div class="submit-buttons <?php echo $opp; ?>">
                          Submit
                        </div>

                      </div>

                    </div>
                  </div>

              </section>

              <?php

              else :

              ?>

              <?php

              endif;

              if ( get_sub_field('section_type') != 'buttons' and get_sub_field('section_type') != 'form' ) {
                array_push($side_menu, get_sub_field('menu_title'));
              }

              $n++;

            endwhile;

        else :

            // no rows found

        endif; ?>





        <section class="blue-primary" id="7">
          <div class="nine columns offset-by-three">
            <div class="schedule-text">
              <div class="schedule-box">
                <span class="strong">Schedule Information</span><br/>
                <span class="blue">Day One</span><br/>
                <span>This is sample text or typography for this space right here.</span><br/>

                <span class="blue">Day One</span><br/>
                <span>This is sample text or typography for this space right here.</span><br/>

                <span class="blue">Day One</span><br/>
                <span>This is sample text or typography for this space right here.</span><br/>

                <span class="blue">Day One</span><br/>
                <span>This is sample text or typography for this space right here.</span><br/>

                <span class="blue">Day One</span><br/>
                <span>This is sample text or typography for this space right here.</span><br/>

                <span class="blue">Day One</span><br/>
                <span>This is sample text or typography for this space right here.</span><br/>
              </div>
              <div class="schedule-box">
                <span class="strong">Schedule Information</span><br/>
                <span class="blue">Day One</span><br/>
                <span>This is sample text or typography for this space right here.</span><br/>

                <span class="blue">Day One</span><br/>
                <span>This is sample text or typography for this space right here.</span><br/>

                <span class="blue">Day One</span><br/>
                <span>This is sample text or typography for this space right here.</span><br/>

                <span class="blue">Day One</span><br/>
                <span>This is sample text or typography for this space right here.</span><br/>

                <span class="blue">Day One</span><br/>
                <span>This is sample text or typography for this space right here.</span><br/>

                <span class="blue">Day One</span><br/>
                <span>This is sample text or typography for this space right here.</span><br/>
              </div>
            </div>
          </div>
        </section>


        <?php

        if ($menu == true) { ?>

          <div class="side-menu">
            <div class="list">
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
                <li>
                  <a href="#5">Skills</a>
                </li>
                <li>
                  <a href="#6">Names</a>
                </li>
                <li>
                  <a href="#7">Schedules</a>
                </li>
              </ul>
            </div>
            <div class="info">
              <a href="#info">Sign up for info</a>
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
