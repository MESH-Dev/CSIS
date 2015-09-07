<?php /*
* Template Name: Global Network
*/
get_header(); ?>


<main id="main" class="site-main" role="main">

  <div class="container">

      <?php

      generateJSON();
      $profiles = getProfileArray();
      //renderProfileGrid($profiles);
      $profile = getSingleProfile($profiles,0);
      //echo $profile['Name | Last'];
      //$filterarray = getFilterLists($profiles, 'Impact | Affiliation | Expertise | Geographic');












      if (get_field('banner') == 'image') {
        $image = get_field('banner_image');

        // vars
        $url = $image['url'];
        $size = 'large';
        $thumb = $image['sizes'][ $size ];

        ?>

        <section class="banner banner-inner" style="<?php if ($image) { ?> background-image: url(<?php echo $thumb; ?>); background-size: cover; width:100%; <?php } ?>">
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
        <div class="four columns yellow-primary-background network-nav-item" id="network-filter-topics">
          Filter By Topics
        </div>
        <div class="four columns yellow-primary-background network-nav-item" id="network-search">
          Search the Network
        </div>
        <div class="four columns yellow-primary-background network-nav-item" id="network-map" >
          Browse the Map <img src="<?php echo get_bloginfo("template_url" ); ?>/img/map-mini.png" alt="">
        </div>
      </section>

      <section class="network-filter-status  ">
        <div class="nine columns filter-list">
          <span class="filter-title">Currently Filtered By: </span>
          Expertise, Marketing, Services
        </div>
        <div class="three columns filter-reset">
          <a href="">RESET FILTER <img src="<?php echo get_bloginfo("template_url" ); ?>/img/refresh.png" alt=""></a>
        </div>
      </section>

      <section class="network-filter-topics network-filter">
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

          <?php 
          //Get Impact Filters and print out checkboxes
          $impactFilters = getFilterLists($profiles, 'Impact');
            foreach($impactFilters as $filter){
              $filter_id = str_replace(" ", "-", $filter);
          ?>
              <div class="topic-checkbox ">
                <input type="checkbox" value="<?php echo $filter; ?>" id="<?php echo $filter_id; ?>" name="impact" />
                <label for="<?php echo $filter_id; ?>"><?php echo $filter; ?></label>
              </div>
            
            <?php } ?>

           
 
        </div>


      </section>


      <section class="network-search network-filter yellow-primary">
        <div class="two columns">
          <div class="filter-title">
              <h4>Search our Global Network:</h4>
          </div>
        </div>
        <div class="ten columns">
          <div class="search">
            <span class="input input--hoshi">
              <input class="input__field input__field--hoshi" type="text" id="network-search" spellcheck="false" />
              <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="network-search">
                <span class="input__label-content input__label-content--hoshi">Search</span>
              </label>
            </span>
          </div>
        </div>
      </section>

      <section class="network-map  network-filter">
        <div class="two columns filter-title">
           <h3>Browse our Global Network:</h3>
        </div>
        <div class="ten columns">
          <div class="map-embed">
            <div id="map-container">
              <div id="map"></div>
            </div>
          </div>
        </div>
      </section>





      <section class="network-grid">
        <div class="three columns " >
          <div class="network-grid-item" style="background-image: url('<?php echo get_bloginfo('template_url' ); ?>/img/portrait.jpg' ); " >
            <div class="hover-info">
              <span class="name">First Last Name</span>
              <span class="title">Title and Org Here</span>
              <span class="location">Pittsburgh</span>
            </div>
          </div>
        </div>


        <div class="three columns " >
          <div class="network-grid-item" style="background-image: url('<?php echo get_bloginfo('template_url' ); ?>/img/portrait.jpg' ); " >
            <div class="hover-info">
              <span class="name">Josh Dodd</span>
              <span class="title">Title and Org Here</span>
              <span class="location">New Jersey</span>
            </div>
          </div>
        </div>

        <div class="three columns " >
          <div class="network-grid-item" style="background-image: url('<?php echo get_bloginfo('template_url' ); ?>/img/portrait.jpg' ); " >
            <div class="hover-info">
              <span class="name">Test Name</span>
              <span class="title">Title and Org Here</span>
              <span class="location">New York</span>
            </div>
          </div>
        </div>


        <div class="three columns " >
          <div class="network-grid-item" style="background-image: url('<?php echo get_bloginfo('template_url' ); ?>/img/portrait.jpg' ); " >
            <div class="hover-info">
              <span class="name">First Last Name</span>
              <span class="title">President</span>
              <span class="location">Atlanta</span>
            </div>
          </div>
        </div>

        <div class="three columns " >
          <div class="network-grid-item" style="background-image: url('<?php echo get_bloginfo('template_url' ); ?>/img/portrait.jpg' ); " >
            <div class="hover-info">
              <span class="name">First Last Name</span>
              <span class="title">Title and Org Here</span>
              <span class="location">New York</span>
            </div>
          </div>
        </div>


        <div class="three columns " >
          <div class="network-grid-item" style="background-image: url('<?php echo get_bloginfo('template_url' ); ?>/img/portrait.jpg' ); " >
            <div class="hover-info">
              <span class="name">First Last Name</span>
              <span class="title">Title and Org Here</span>
              <span class="location">New York</span>
            </div>
          </div>
        </div>

        <div class="three columns " >
          <div class="network-grid-item" style="background-image: url('<?php echo get_bloginfo('template_url' ); ?>/img/portrait.jpg' ); " >
            <div class="hover-info">
              <span class="name">First Last Name</span>
              <span class="title">Title and Org Here</span>
              <span class="location">New York</span>
            </div>
          </div>
        </div>


        <div class="three columns " >
          <div class="network-grid-item" style="background-image: url('<?php echo get_bloginfo('template_url' ); ?>/img/portrait.jpg' ); " >
            <div class="hover-info">
              <span class="name">First Last Name</span>
              <span class="title">Title and Org Here</span>
              <span class="location">New York</span>
            </div>
          </div>
        </div>



      </section>

      <section class="load-more">
        <div class="three columns offset-by-five load-more-btn">
          Load More
        </div>
      </section>



  </div>

</main><!-- #main -->

<?php get_footer(); ?>
