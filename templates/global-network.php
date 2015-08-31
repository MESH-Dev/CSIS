<?php /*
* Template Name: Global Network
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

      <section class="network-nav">
        <div class="four columns yellow-primary-background network-nav-item">
          Filter By Topics  
        </div>
        <div class="four columns yellow-primary-background network-nav-item">
          Search the Network
        </div>
        <div class="four columns yellow-primary-background network-nav-item">
          Browse the Map <img src="<?php echo get_bloginfo("template_url" ); ?>/img/map-mini.png" alt=""> 
        </div>
      </section>

      <section class="network-filter-status">
        <div class="nine columns filter-list">
          <span class="filter-title">Currently Filtered By: </span>
          Expertise, Marketing, Services
        </div>
        <div class="three columns filter-reset">
          <a href="">RESET FILTER <img src="<?php echo get_bloginfo("template_url" ); ?>/img/refresh.png" alt=""></a>
        </div> 
      </section>

      <section class="network-filter-topics">
        <div class="two columns topic-list">
          <span class="filter-by">Filter By: </span>
          <ul>
            <li>Impact Areas</li>
            <li>Expertise</li>
            <li>Geographic Interest</li>
            <li>Affiliation</li>
            <li>Year</li>
          </ul>
        </div>
        <div class="ten columns topic-items">
          
          <div class="topic-checkbox ">
            <input type="checkbox" value="None" id="TopicName1" name="check" />
            <label for="TopicName1">Accounting & Finance</label>
          </div>
          
          <div class="topic-checkbox">
            <input type="checkbox" value="None" id="TopicName2" name="check" />
            <label for="TopicName2">Budgeting</label>
          </div>
          
          <div class="topic-checkbox">
            <input type="checkbox" value="None" id="TopicName3" name="check" />
            <label for="TopicName3">Label Here</label>
          </div>
          <div class="topic-checkbox">
            <input type="checkbox" value="None" id="TopicName4" name="check" />
            <label for="TopicName4">Label Here</label>
          </div>
          <div class="topic-checkbox">
            <input type="checkbox" value="None" id="TopicName5" name="check" />
            <label for="TopicName5">Label Here</label>
          </div>
          <div class="topic-checkbox">
            <input type="checkbox" value="None" id="TopicName6" name="check" />
            <label for="TopicName6">Label Here</label>
          </div>
          <div class="topic-checkbox">
            <input type="checkbox" value="None" id="TopicName7" name="check" />
            <label for="TopicName7">Label Here</label>
          </div>
          <div class="topic-checkbox">
            <input type="checkbox" value="None" id="TopicName3" name="check" />
            <label for="TopicName3">Label Here</label>
          </div>

          
        </div>


      </section>


      <section class="network-search">
        
      </section>






      <section class="network-grid">
        <div class="three columns " >
          <a href="#" class="network-grid-item" >
            <img src="<?php echo get_bloginfo("template_url" ); ?>/img/portrait.jpg" alt="">
            <div class="hover-info">
              <span class="name">First Last Name</span>
              <span class="title">Title and Org Here</span>
              <span class="location">New York</span>
            </div>
          </a>
        </div>

        <div class="three columns " >
          <a href="#" class="network-grid-item" >
            <img src="<?php echo get_bloginfo("template_url" ); ?>/img/portrait.jpg" alt="">
            <div class="hover-info">
              <span class="name">First Last Name</span>
              <span class="title">Title and Org Here</span>
              <span class="location">New York</span>
            </div>
          </a>
        </div>

        <div class="three columns " >
          <a href="#" class="network-grid-item" >
            <img src="<?php echo get_bloginfo("template_url" ); ?>/img/portrait.jpg" alt="">
            <div class="hover-info">
              <span class="name">First Last Name</span>
              <span class="title">Title and Org Here</span>
              <span class="location">New York</span>
            </div>
          </a>
        </div>

        <div class="three columns " >
          <a href="#" class="network-grid-item" >
            <img src="<?php echo get_bloginfo("template_url" ); ?>/img/portrait.jpg" alt="">
            <div class="hover-info">
              <span class="name">First Last Name</span>
              <span class="title">Title and Org Here</span>
              <span class="location">New York</span>
            </div>
          </a>
        </div>

        <div class="three columns " >
          <a href="#" class="network-grid-item" >
            <img src="<?php echo get_bloginfo("template_url" ); ?>/img/portrait.jpg" alt="">
            <div class="hover-info">
              <span class="name">First Last Name</span>
              <span class="title">Title and Org Here</span>
              <span class="location">New York</span>
            </div>
          </a>
        </div>

        <div class="three columns " >
          <a href="#" class="network-grid-item" >
            <img src="<?php echo get_bloginfo("template_url" ); ?>/img/portrait.jpg" alt="">
            <div class="hover-info">
              <span class="name">First Last Name</span>
              <span class="title">Title and Org Here</span>
              <span class="location">New York</span>
            </div>
          </a>
        </div>

        <div class="three columns " >
          <a href="#" class="network-grid-item" >
            <img src="<?php echo get_bloginfo("template_url" ); ?>/img/portrait.jpg" alt="">
            <div class="hover-info">
              <span class="name">First Last Name</span>
              <span class="title">Title and Org Here</span>
              <span class="location">New York</span>
            </div>
          </a>
        </div>

        <div class="three columns " >
          <a href="#" class="network-grid-item" >
            <img src="<?php echo get_bloginfo("template_url" ); ?>/img/portrait.jpg" alt="">
            <div class="hover-info">
              <span class="name">First Last Name</span>
              <span class="title">Title and Org Here</span>
              <span class="location">New York</span>
            </div>
          </a>
        </div>

        <div class="three columns " >
          <a href="#" class="network-grid-item" >
            <img src="<?php echo get_bloginfo("template_url" ); ?>/img/portrait.jpg" alt="">
            <div class="hover-info">
              <span class="name">First Last Name</span>
              <span class="title">Title and Org Here</span>
              <span class="location">New York</span>
            </div>
          </a>
        </div>


       
      </section>

     

  </div>

</main><!-- #main -->

<?php get_footer(); ?>
