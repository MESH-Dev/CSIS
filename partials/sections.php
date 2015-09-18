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

      <section class="<?php echo get_sub_field('color'); ?>-background" style="<?php if ($image) { ?> background-image: url(<?php echo $thumb; ?>); background-size: cover; background-repeat: no-repeat; <?php } ?>">

        <div class="callout-screen">

          <div class="callout-panel">

            <div class="ten columns">
              <div class="callout-text">
                <h2><a href="<?php echo get_sub_field('link_1'); ?>"><?php echo get_sub_field('section_title'); ?></a></h2>
                <p><?php echo get_sub_field('body_text'); ?></p>
              </div>
            </div>
            <div class="two columns">
              <?php if (get_sub_field('link_1')) { ?><a href="<?php echo get_sub_field('link_1'); ?>"><?php } ?>
                <div class="cta-big">
                  <div class="cta-text">
                    <span class="right"></span>
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

      elseif (get_sub_field('section_type') == 'text') :

      ?>

      <section class="text">
        <div class="three columns">
          <div class="content-text side-text">
            <?php echo get_sub_field('side_text'); ?>
          </div>
        </div>
        <div class="six columns">
          <div class="content-text">
            <?php echo get_sub_field('body_text'); ?>



            <?php if (get_field('column_1_text')) { ?>
              <br/>

              <div class="six columns content-half">
                <?php echo get_field('column_1_text'); ?>
              </div>
            <?php } ?>

            <?php if (get_field('column_2_text')) { ?>
              <div class="six columns content-half">
                <?php echo get_field('column_2_text'); ?>
              </div>
            <?php } ?>

          </div>
        </div>
      </section>

      <?php

      elseif (get_sub_field('section_type') == 'image-with-text') :

      ?>

      <section class="image-with-text" style="<?php if ($image) { ?> background-image: url(<?php echo $thumb; ?>); background-size: cover; background-position-y: 20%; background-repeat: no-repeat; <?php } ?>" >
        <div class="four columns image-holder">
          <div class="image-text">
            <?php echo get_sub_field('body_text'); ?>
          </div>
        </div>
      </section>

      <?php

      elseif ( get_sub_field('section_type') == 'image' ) :

      ?>

      <section class="image" style="<?php if ($image) { ?> background-image: url(<?php echo $thumb; ?>); background-size: cover; background-position-y: 20%;  background-repeat: no-repeat; <?php } ?>" >
      </section>


      <?php

      elseif ( get_sub_field('section_type') == 'video' ) :

      ?>

      <?php

        if (get_sub_field('video_type') == 'vimeo') {
          $video = "https://player.vimeo.com/video/" . get_sub_field('video');
        } elseif (get_sub_field('video_type') == 'youtube') {
          $video = "https://www.youtube.com/embed/" . get_sub_field('video');
        } else {
          $video == '';
        }

      ?>

      <section class="video" >

        <style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe src='<?php echo $video;?>' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>

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
                  $text = get_sub_field('2-column_body_text');
                  $texttitle = get_sub_field('2-column_title');

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

                <div class="six columns <?php echo get_sub_field('color'); ?>-background hover" style="<?php if ($image) { ?> background-image: url(<?php echo $thumb; ?>); background-size: cover; background-repeat: no-repeat; <?php } ?>">

                  <div class="callout-screen <?php if( $image !='' && $text =='' && $texttitle =='' ){ ?> no-screen <?php }?>  hover ">

                    <div class="listing-text">
                      <h3>
                        <?php if (get_sub_field('2_column_link')) { ?>
                          <a href="<?php echo get_sub_field('2_column_link'); ?>"> <?php } ?><?php echo get_sub_field('2_column_title'); ?><?php if (get_sub_field('2_column_link')) { ?></a><?php } ?></h3>
                      <p><?php echo get_sub_field('2-column_body_text'); ?></p>
                      <?php if (get_sub_field('2_column_link')) { ?>
                      <div class="cta-small">
                        <div class="cta-text">
                          <a href="<?php echo get_sub_field('2_column_link'); ?>">

                            <?php echo get_sub_field('2_column_link_text'); ?>

                            <span class="right"></span>

                          <?php if (get_sub_field('2_column_link')) { ?></a><?php } ?>
                        </div>
                      </div>
                      <?php } ?>
                    </div>

                  </div>

                </div>

              <?php endwhile; ?>

           <?php endif; //if( get_sub_field('items') ): ?>


      </section>

      <?php

      elseif ( get_sub_field('section_type') == '2-column-media' ) :

      ?>

      <section class="media">

          <?php

            if( have_rows('2-column_media') ): ?>

              <?php

              while( have_rows('2-column_media') ): the_row();

                if (get_sub_field('2-column_media_type') == '2-column_image') {

                  if (get_sub_field('2-column_image')) {

                    $image = get_sub_field('2-column_image');

                    // thumbnail
                    $size = 'large';
                    $thumb = $image['sizes'][ $size ];

                  } else {
                    $thumb = '';
                  }

                  ?>

                  <div class="six columns media-image" style="<?php if ($image) { ?> background-image: url(<?php echo $thumb; ?>); background-size: cover; height: 100%; background-repeat: no-repeat; <?php } ?>">
                  </div>

                  <?php

                }
                elseif (get_sub_field('2-column_media_type') == '2-column_video') {

                  ?>

                  <div class="six columns media-video">

                    <div class="video-holder">
                      <?php

                      $video = get_sub_field('2-column_video');
                      echo $video;

                      ?>
                    </div>


                  </div>

                  <?php

                }
                elseif (get_sub_field('2-column_media_type') == '2-column_youtube') {

                  ?>

                  <div class="six columns media-item">

                    <div class="information-video">

                      <div class="video-container">

                        <?php

                        $video = get_sub_field('2-column_youtube');

                        ?>

                        <style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe src='https://www.youtube.com/embed/<?php echo $video; ?>' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>

                      </div>

                    </div>


                  </div>

                  <?php

                }
                else { ?>
                  <div class="six columns media-item">

                    <div class="text-holder">
                      <?php

                      $media_text = get_sub_field('2-column_text');
                      echo $media_text;

                      ?>
                    </div>


                  </div>
              <?php    }

              ?>

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

                <div class="four columns <?php echo get_sub_field('color'); ?>-background hover ">
                  <div class="listing-text">
                    <h3>
                       <?php if (get_sub_field('3-column_link')) { ?><a href="<?php echo get_sub_field('3-column_link'); ?>"> <?php } ?>
                        <?php echo get_sub_field('3-column_title'); ?>
                       <?php if (get_sub_field('3-column_link')) { ?></a> <?php } ?>
                     </h3>
                    <p><?php echo get_sub_field('3-column_body_text'); ?></p>
                    <?php if (get_sub_field('3-column_link')) { ?>
                      <div class="cta-small">
                        <div class="cta-text">
                          <a href="<?php echo get_sub_field('3-column_link'); ?>">

                            <?php echo get_sub_field('3-column_link_text'); ?>

                            <span class="right"></span>

                          <?php if (get_sub_field('3-column_link')) { ?></a><?php } ?>
                        </div>
                      </div>
                    <?php } ?>
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
                <span class="right"></span>
              </div>

            </a>

            <a href="<?php echo get_sub_field('link_2') ?>">
              <div class="buttons-cta <?php echo $color; ?>-background">
                <?php echo get_sub_field('link_text_2') ?>
                <span class="right"></span>
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
              <form id="general-email" >
                <span class="input input--hoshi">
                  <input class="input__field input__field--hoshi" type="email" id="email" spellcheck="false" />
                  <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="email">
                    <span class="input__label-content input__label-content--hoshi">Email</span>
                  </label>
                  <input type="hidden" id="ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" />
                </span>
              </form>
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

?>
