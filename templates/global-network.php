<?php /*
* Template Name: Global Network
*/
get_header(); ?>


<main id="main" class="site-main" role="main">

  <div class="container">

      <?php

      //generateJSON();
      $profiles = getProfileArray();
      //writeLatLong($profiles);
      //renderProfileGrid($profiles);
      //$profile = getSingleProfile($profiles,0);
      //echo $profile['Name | Last'];
      //$filterarray = getFilterLists($profiles, 'Impact | Affiliation | Expertise | Geographic | Year');
 

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
        <div class="four columns yellow-primary-background network-nav-item reset" id="network-search">
          Search the Network
        </div>
        <div class="four columns yellow-primary-background network-nav-item" id="network-map" >
          Browse the Map <img src="<?php echo get_bloginfo("template_url" ); ?>/img/map-mini.png" alt="">
        </div>
      </section>

      <section class="network-filter-status  ">
        <div class="nine columns filter-list">
          <span class="filter-title">Currently Filtered By: </span>
          <span class="filtered-list">All</span>
        </div>
        <div class="three columns filter-reset">
          <a id="reset" class="reset" href="">RESET FILTER <img src="<?php echo get_bloginfo("template_url" ); ?>/img/refresh.png" alt=""></a>
        </div>
      </section>

      <section class="network-filter-topics network-filter">
        <div class="two columns topic-list">
          <span class="filter-by">Filter By: </span>

            <li data-id="impact">Impact Areas</li>
            <li data-id="expertise">Expertise</li>
            <li data-id="geographic">Geographic Interest</li>
            <li data-id="affiliation">Affiliation</li>
            <li data-id="year">Year</li>
          </ul>
        </div>
        <div class="ten columns topic-items">
          <form class="controls" id="Filters">
            <fieldset name="impact">

                <?php
                //Get Impact Filters and print out checkboxes
                $impactFilters = getFilterLists($profiles, 'Impact');
                foreach($impactFilters as $filter){
                  $filter_id = str_replace(" ", "-", $filter);
                  $filter_id = str_replace("&", "", $filter_id);
                ?>
                  <div class="topic-checkbox checkbox ">
                    <input type="checkbox" value=".<?php echo $filter_id; ?>" data-filter="<?php echo $filter;?>" id="<?php echo $filter_id; ?>"  />
                    <label for="<?php echo $filter_id; ?>"><?php echo $filter; ?></label>
                  </div>

                <?php } ?>

            </fieldset>

            <fieldset name="expertise">

              <?php
              //Get Expertise Filters and print out checkboxes
              $impactFilters = getFilterLists($profiles, 'Expertise');
              foreach($impactFilters as $filter){
                $filter_id = str_replace(" ", "-", $filter);
                $filter_id = str_replace("&", "", $filter_id);
              ?>
                <div class="topic-checkbox checkbox ">
                  <input type="checkbox" value=".<?php echo $filter_id; ?>" data-filter="<?php echo $filter;?>"  id="<?php echo $filter_id; ?>"   />
                  <label for="<?php echo $filter_id; ?>"><?php echo $filter; ?></label>
                </div>

              <?php } ?>

            </fieldset>

            <fieldset name="geographic">

              <?php
              //Get Geo Filters and print out checkboxes
              $impactFilters = getFilterLists($profiles, 'Geographic');
              foreach($impactFilters as $filter){
                $filter_id = str_replace(" ", "-", $filter);
                $filter_id = str_replace("&", "", $filter_id);
              ?>
                <div class="topic-checkbox checkbox ">
                  <input type="checkbox" value=".<?php echo $filter_id; ?>" data-filter="<?php echo $filter;?>"  id="<?php echo $filter_id; ?>"   />
                  <label for="<?php echo $filter_id; ?>"><?php echo $filter; ?></label>
                </div>

              <?php } ?>

            </fieldset>

            <fieldset name="affiliation">

              <?php
              //Get Affil Filters and print out checkboxes
              $impactFilters = getFilterLists($profiles, 'Affiliation');
              foreach($impactFilters as $filter){
                $filter_id = str_replace(" ", "-", $filter);
                $filter_id = str_replace("&", "", $filter_id);
              ?>
                <div class="topic-checkbox checkbox ">
                  <input type="checkbox" value=".<?php echo $filter_id; ?>" data-filter="<?php echo $filter;?>"  id="<?php echo $filter_id; ?>"  />
                  <label for="<?php echo $filter_id; ?>"><?php echo $filter; ?></label>
                </div>

              <?php } ?>

            </fieldset>

            <fieldset name="year">
 
                <div class="topic-checkbox checkbox ">
                  <input type="checkbox" value=".2012" data-filter="2012" id=".2012" />
                  <label for=".2012">2012</label>
                </div>

                
                <div class="topic-checkbox checkbox ">
                  <input type="checkbox" value=".2013" data-filter="2013" id=".2013" />
                  <label for=".2013">2013</label>
                </div>

                <div class="topic-checkbox checkbox ">
                  <input type="checkbox" value=".2014" data-filter="2014" id=".2014" />
                  <label for=".2014">2014</label>
                </div>

                <div class="topic-checkbox checkbox ">
                  <input type="checkbox" value=".2015" data-filter="2015" id=".2015" />
                  <label for=".2015">2015</label>
                </div>
 
            </fieldset>

          </div>
        </form>

        <div class="close-filter"><a href="">X</a></div>
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
        <div class="close-filter"><a href="">X</a></div>
      </section>

      <section class="network-map  network-filter">
        <div class="two columns filter-title">
           <h4>Browse our Global Network:</h4>
        </div>
        <div class="ten columns">
          <div class="map-embed">
            <div id="map-container">
              <div id="map"></div>
            </div>
          </div>
        </div>
        <div class="close-filter"><a href="">X</a></div>
      </section>





      <section id="network-grid" class="network-grid">
        <div class="fail-message" ><span>No items were found matching the selected filters</span></div>
         <?php renderProfileGrid($profiles); ?>
      </section>

      <!--<section class="load-more">
        <div class="three columns offset-by-five load-more-btn">
          Load More
        </div>
      </section>
    -->





  </div>

  <div class="profile-container">
        <div class="container profile-content">


          <div id="loader" class="twelve columns">
            <img src="<?php echo get_bloginfo("template_url" ); ?>/img/ajax-loader.gif" alt="">
          </div>
        </div>
        <div class="close-profile">
          <a href="#">X</a>
        </div>
  </div>

</main><!-- #main -->

<?php get_footer(); ?>
