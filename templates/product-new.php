<?php /*
* Template Name: Product New
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

<main id="main" class="site-main new-product" role="main">

  <div class="">

      <?php

      $info = false;
      $apply = false;

        //if (get_field('banner') == 'image') {
        $image = get_field('pp_background_image');

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

        $banner_subheader = get_field('sub_header');

        ?>

        <section class="banner banner-inner" style="text-align:center; <?php if ($image) { ?> background-image: url(<?php echo $thumb; ?>); background-size: cover; background-repeat: no-repeat; background-attachment:fixed; background-position-x: center; background-position-y: center; <?php } ?>">

            <div class="banner-screen"></div>
            
              <div class="banner-text">
                <div class="banner-title"><?php the_title(); ?></div>
                <div class="banner-subheader"><h2><?php echo $banner_subheader; ?></h2></div>
                <!-- Buttons -->
                <?php if (have_rows('buttons')): ?>
                <div class="banner-buttons row">
                  <div class="banner-buttons-wrap">
                  <?php 
                    while(have_rows('buttons')):the_row();
                      $button_text = get_sub_field('button_text');
                      $button_url = get_sub_field('button_link');
                  ?>
                  <div class="cta-wrap has-gradient">
                    <div class="cta-button">
                      <a class="cta-link" href="<?php echo $button_url; ?>"><?php echo $button_text; ?></a>
                    </div>
                  </div>
                <?php endwhile; ?>
                </div>
              </div>
              <?php endif; ?>
              
              <?php if (have_rows('banner_cta')): ?>
                <div class="banner-callout">
                  <?php while(have_rows('banner_cta')):the_row(); 
                    $banner_cta_text = get_sub_field('banner_cta_text');
                      $banner_cta_url = get_sub_field('banner_cta_link'); 
                  ?>
                  <h3>
                    <?php if ($banner_cta_url != '') { ?>
                    <a href="<?php echo $banner_cta_url; ?>">
                    <?php } ?>
                      <?php echo $banner_cta_text; ?>
                    <?php if ($banner_cta_url != '') { ?>
                    </a>
                    <?php } ?>
                  </h3>
                <?php endwhile; ?>
              </div>
            <?php endif; ?>

        </section>

      <?php

        // check if the repeater field has rows of data
        if( have_rows('sections') ):

          $n = 0;
          $side_menu = array();

          // loop through the rows of data
            while ( have_rows('sections') ) : the_row();

              $removes = array('&amp;', '&');

              $menu_item = get_sub_field('menu_title');

              $menu_strip = rtrim(strtolower($menu_item));
              $menu_id = str_replace($removes, '', $menu_strip);

              $menu_title = preg_replace('/\s+/', '_', $menu_id);

              $color = get_field('color');
              $bg_color = get_sub_field('background_color');
              $section_title = get_sub_field('section_title');
              $title_color = get_sub_field('section_title_color');

              $t_col='';
              if($title_color == 'new-red'){
                $t_col = 'new-red';
              }elseif($title_color == 'new-blue'){
                $t_col = 'new-blue';
              }elseif($title_color == 'new-purple'){
                $t_col = 'new-purple';
              }elseif($title_color == 'new-yellow'){
                $t_col = 'new-yellow';
              }else{
                $t_col = '';
              }


              $bg = '';

              if($bg_color == 'gray'){
                $bg = 'gray-background';
              }

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

              ?>

              <?php

              if ( get_sub_field('section_type') == 'body-text' ) :


              ?>

              <section class="body-text content-row <?php echo $bg; ?>" id="<?php echo $menu_title; $n; $n++; ?>" data-menu="<?php echo $menu_title; ?>">
                <div class="container neues product">
                  <div class="row">
                    <?php if($section_title){ ?>
                   <div class="section-title" >
                      <h2 <?php if($t_col != ''){ echo 'class="'.$t_col.'"'; } ?>> <?php echo $section_title; ?></h2>
                    </div>
                    <?php } ?>
                    <!-- <div class="nine columns">
                      <div class="body-text-area"> -->
                        <?php //echo get_sub_field('body_text'); ?>

                        <!-- <br/> -->
                        <?php 
                        
                        //__Get the number of rows in our repeater
                        //__Not sure why this has to be done outside of the loop, but 
                        //  it may have something to do with the fact that it is nested
                        $rows = get_sub_field('body_text_columns');
                        $count = count($rows);

                        if (have_rows('body_text_columns')):
                                while(have_rows('body_text_columns')):the_row(); 
                                  $column = get_sub_field('body_text_column');

                                  //This time, the row count has to be done outside of this loop
                                  $column_class="";
                                  if($count == 1){
                                    $column_class = 'columns twelve';
                                  }elseif($count ==2){
                                    $column_class = 'columns six';
                                  }elseif($count ==3){
                                    $column_class = 'columns four';
                                  }
                                ?>
                                <div class="body-text-column <?php echo $column_class; ?>"><?php echo $column; ?></div>
                        <?php endwhile; endif; ?>
                  </div>
                </div>
              </section>

              <?php

              elseif ( get_sub_field('section_type') == 'image' ) :

              ?>
              <?php 

                $the_image = get_sub_field('images');
                $first_image_row = $the_image[0];
                $first_image = $first_image_row['image'];
                $first_image_url = $first_image['sizes']['background-fullscreen'];
                //var_dump($first_image_url);
                $video_link = get_sub_field('video_link');
                $video_type = get_sub_field('video_type');
                $image_count = count($the_image);
                //var_dump($image_count);

                if (have_rows('images')): ?>
               
                <section class="image content-row <?php if($video_link){ echo 'is_modal';} ?>" style="<?php if ($first_image_url) { ?> background-image: url(<?php echo $first_image_url; ?>); background-size: cover; background-repeat: no-repeat; background-position-y: 20%;  <?php } ?>" id="<?php echo $n; $n++; ?>" data-menu="<?php echo $menu_title; ?>">
                  <div class="top-border has-gradient"></div>
                   <?php if($video_link){ ?>
                    <div class="is_modal" data-type="<?php echo $video_type; ?>" data-src="<?php echo $video_link; ?>">
                      <!-- <a href="<?php echo $video_link ?>" > -->
                    <?php } ?>
                  <?php if($section_title != ''){ ?>
                  <div class="image-title">
                    <div class="content">
                      <h1><?php echo $section_title; ?> <?php if ($video_link){ echo '<br><i class="fa fa-fw fa-play-circle-o"></i>'; }?></h1>
                    </div>
                  </div>
                  <?php } ?>
                  <?php if($video_link){ ?>
                    </div>
                    <!-- </a> -->
                  <?php } ?>
                  <div <?php if($image_count > 1){ echo 'class="slick-images"'; }?>>
                  <?php while(have_rows('images')):the_row();

                      $section_image  = get_sub_field('image');

                      // vars
                      $url = $section_image['url'];
                      $title = $section_image['title'];
                      $alt = $section_image['alt'];
                      $caption = $section_image['caption'];

                      // thumbnail
                      //$size = 'large';
                      $size = 'background-fullscreen';
                      $thumb = $section_image['sizes'][ $size ];
                      $width = $section_image['sizes'][ $size . '-width' ];
                      $height = $section_image['sizes'][ $size . '-height' ];

              ?>

                <div class="image-slick" style="height:400px; background-image:url('<?php echo $thumb; ?>');background-size: cover; background-repeat: no-repeat; background-position-y: 20%; ">

                </div>

              <?php endwhile; ?>
              </div>
            </section>
              <?php endif; ?>



              <?php

              elseif ( get_sub_field('section_type') == 'icon_listing' ) :
               
              ?>

              <section class="listing content-row <?php echo $bg; ?>" id="<?php echo $menu_title; $n; $n++;?>" data-menu="<?php echo $menu_title; ?>">
                  <div class="container neues product">
                    <div class="row">
                      <div class=""><!-- nine columns -->
                        <?php if($section_title){ ?>
                        <div class="section-title" >
                            <h2 <?php if($t_col != ''){ echo 'class="'.$t_col.'"'; } ?>> <?php echo $section_title; ?></h2>
                        </div>
                        <?php } ?>
                        <div class="icons-text">

                        <?php

                          if( have_rows('icon_listing') ): 
                             $icon_cnt=0;
                            ?>

                            <?php

                            while( have_rows('icon_listing') ): the_row();
                              $icon_cnt++;
                              $icon_image = get_sub_field('listing_icon');

                              // vars
                              $url = $icon_image['url'];
                              $title = $icon_image['title'];
                              $alt = $icon_image['alt'];
                              $caption = $icon_image['caption'];

                              // thumbnail
                              $size = 'large';
                              $icon_thumb = $icon_image['sizes'][ $size ];
                              $width = $icon_image['sizes'][ $size . '-width' ];
                              $height = $icon_image['sizes'][ $size . '-height' ];

                              ?>

                                <div class="icon-box four columns">
                                  <p class="icon">
                                    <img src="<?php echo $icon_thumb; ?>" />
                                  </p>
                                  
                                  <h3 class="listing-title"><?php echo get_sub_field('listing_title'); ?></h3>
                                  
                                  <p>
                                    <?php echo get_sub_field('listing_body_text'); ?>
                                  </p>
                                </div>

                            <?php endwhile; ?>

                         <?php endif; //if( get_sub_field('items') ): ?>

                      </div>
                    </div>
                  </div>

              </section>

              <?php

              elseif ( get_sub_field('section_type') == 'buttons' ) :

                $apply = true;

                $n++;

              ?>

              <section class="buttons content-row" id="<?php echo $menu_title; $n; $n++;?>" data-menu="<?php echo $menu_title; ?>">
                <div class="container neues product">
                  <div class="row">
                <?php if (have_rows('buttons')):
                        while(have_rows('buttons')):the_row();
                        $button_icon = get_sub_field('button_icon');
                        $b_icon_url = $button_icon['sizes']['medium'];
                        //var_dump($button_icon);

                        $button_text = get_sub_field('button_text');
                        $button_link = get_sub_field('button_link');
                        $button_color = get_sub_field('button_bg_color');

                        $bg_col='';
                        if($button_color == 'new-red'){
                          $bg_col = 'new-red';
                        }elseif($button_color == 'new-blue'){
                          $bg_col = 'new-blue';
                        }elseif($button_color == 'new-purple'){
                          $bg_col = 'new-purple';
                        }elseif($button_color == 'new-yellow'){
                          $bg_col = 'new-yellow';
                        }else{
                          $bg_col = '';
                        }
                        ?>

                        <div class="columns six button-wrap" style="padding:5px;">
                          <a href="<?php echo $button_link; ?>">
                          <div class="big-button <?php if($button_color){ echo $bg_col.'-background'; }?>" style="padding:0 20px;">
                            <div class="big-button-content">
                              <div class="row">
                                <div class="b-img">
                                  <img src="<?php echo $b_icon_url; ?>">
                                </div>
                                <div class="b-label">
                                  <h3><?php echo $button_text; ?></h3>
                                </div>
                              </div>
                            </div>
                          </div>
                          </a>
                        </div>

                <? endwhile; endif; ?>
              </div>
            </div>
               

              </section>
            <?php

              elseif (get_sub_field('section_type') == 'faq'):
                
                //Get the array of repeater fields
                $faq_rows = get_sub_field('faq');
                //Count the number of repeater fields
                $faq_count = count($faq_rows);

                //__We're going to split the rendered rows into two batches,
                //  so:
                //  _Divide the number of rows by 2
                $faq_half = $faq_count/2; 
                //var_dump($faq_half);
                //  _Round the number from above by 2 to find out where to split
                $faq_round = round($faq_half); 
                //var_dump($faq_round);
                //var_dump($faq_count);
              if(have_rows('faq')): 
                  //Set up a count, we'll need that for a comparison to figure out where we are in the loop
                  $f_cnt=0;
                ?>

              <section class="faq content-row" id="<?php echo $menu_title; ?>" data-menu="<?php echo $menu_title; ?>">
                <div class="container neues product">
                  <?php if ($section_title != ''){ ?>
                  <div class="section-title" >
                      <h2 <?php if($t_col != ''){ echo 'class="'.$t_col.'"'; } ?>> <?php echo $section_title; ?></h2>
                  </div>
                    <?php } ?>
                  <div class="row">
                    <?php //We're going to wrap each half in a column, so let's start ?>
                    <div class="columns six">
                  <?php while(have_rows('faq')):the_row();
                        $f_cnt++;
                        $question = get_sub_field('faq_question');
                        $answer = get_sub_field('faq_answer');
                  ?>
                  <?php 
                      //__If the current rendered block is equal to our rounded count # + 1,
                      //  end the column
                      if($f_cnt == $faq_round+1){ ?>
                    </div><div class="columns six">
                  <?php }?>
                  <div class="faq-block <?php echo $f_cnt; ?>">
                    <div class="question row">
                      <h2><?php echo $question; ?></h2>
                      <span><i class="fa fa-fw fa-chevron-down"></i></span>
                    </div>
                    <div class="answer"><?php echo $answer; ?></div>
                  </div>
                <?php 
                    //If we've rendered all of our counted rows, end the column
                    if ($faq_count-$f_cnt == 0){ ?>
                  </div><!--This is only needed if the column is complete-->
                  <?php } ?>
              <?php endwhile; ?>
                </div>
              </section>
              <?php endif; ?>
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

                      <?php if(strlen($value) > 0) { 

                        //$value_trim = rtrim($value);
                        $removes = array('&amp;', '&');
                        $value_trim = str_replace($removes, '', rtrim($value));

                        $value_strip = preg_replace('/\s+/', '_', $value_trim);

                        ?>

                        <li><a href="#<?php echo strtolower($value_strip); //$i// ?>"><?php echo $value; ?></a></li>

                      <?php } ?>

                    <?php

                    $i++;
                  }

                ?>
              </ul>
            </div>
            <?php if (have_rows('apply_button')):
                    while(have_rows('apply_button')):the_row(); 
                      $apply_text = get_sub_field('apply_button_text');
                      $apply_link = get_sub_field('apply_button_link');
                      $external = get_sub_field('external');

                      $target= "";
                      if($external == true){
                        $target = 'target="_blank"';
                      }
                    ?>
            <div class="apply has-gradient">
              <a href="<?php echo $apply_link; ?>" <?php if($target != ''){ echo $target; } ?> ><?php echo $apply_text; ?></a>
            </div>
          <?php endwhile; ?>
          <?php else: ?>
            <div class="apply has-gradient">
              <a href="#apply">Apply Now</a>
            </div>
          <?php endif; ?>
          </div>

        <?php
        }

      ?>


  </div>

</main><!-- #main -->

<?php get_footer(); ?>
