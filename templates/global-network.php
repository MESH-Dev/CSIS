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

      $row = 1;
      $csv = get_template_directory_uri() . '/data/data.csv';

      if (($handle = fopen($csv, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
          $num = count($data);

          if ($row != 1) {

            for ($c=0; $c < $num; $c++) {
                // echo $data[$c];
            }

            // echo "<br/>";
          }

          $row++;
        }
        fclose($handle);
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


      <section class="network-search network-filter yellow-primary">
        <div class="two columns">
          <div class="filter-title">
              <h4>Search our Global Network:</h4>
          </div>
        </div>
        <div class="ten columns">
          <div class="search">
            <span class="input input--hoshi">
              <input class="input__field input__field--hoshi" type="text" id="input-4" spellcheck="false" />
              <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
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
