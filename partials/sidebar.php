<div class="blog-sidebar">
  <div class="blog-sidebar-title ">
    <div class="blog-sidebar-title-text <?php if (is_category()) { echo 'active-sidebar-title'; } ?>">Categories</div>
    <i class="fa <?php if (is_category()) { echo 'fa-caret-down'; } else { echo 'fa-caret-right'; } ?>"></i>
  </div>
  <div class="blog-categories <?php if (is_category()) { echo 'active-category'; } ?>">
    <ul>
      <?php
      $args = array(
        'orderby' => 'name',
        'parent' => 0
        );
      $categories = get_categories( $args );
      //var_dump($categories);
      //var_dump($args);
      foreach ( $categories as $category ) {

        if (is_category( $category->name )) {
          $iscat = 'active';
        } else {
          $iscat = '';
        }

          echo '<li class="' . $iscat . '"><a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a></li>';
      } wp_reset_postdata();

      var_dump(wp_list_authors());
      ?>
    </ul>
  </div>
  <div class="blog-sidebar-title">
    <div class="blog-sidebar-title-text <?php if (is_author()) { echo 'active-sidebar-title'; } ?>">Authors</div>
    <i class="fa <?php if (is_author()) { echo 'fa-caret-down'; } else { echo 'fa-caret-right'; } ?>"></i>
  </div>
  <div class="blog-categories <?php if (is_author()) { echo 'active-category'; } ?>">
    <ul>
      <?php //add_filter("the_authors_link", "get_authors_link_mod");?>

      <?php 

          // prepare arguments
          $args  = array(
          // search only for Authors role
          //'role' => 'Author',
            'has_published_posts' => array('post'),
            'exclude' => array(2),
          // order results by display_name
          'orderby' => 'display_name',
          );
          // Create the WP_User_Query object
          $wp_user_query = new WP_User_Query($args);
          // Get the results
          $authors = $wp_user_query->get_results();
          //var_dump($authors);

          // Check for results
          if (!empty($authors))
          {
             echo '<ul>';
             // loop trough each author
             foreach ($authors as $author)

             {
                  if (is_author( $author->ID )) {
                    $isauth = 'active';
                  } else {
                    $isauth = '';
                  }
                 // get all the user's data
                 $author_info = get_userdata($author->ID);
                 echo '<li class="'. $isauth .'"><a href="'.get_author_posts_url($author->ID).'">'.$author_info->first_name.' '.$author_info->last_name.'</a></li>';
             }
             echo '</ul>';
          } else {
             echo 'No authors found';
          }

      ?>
      <?php //wp_list_authors( $args ); ?>
    </ul>
  </div>
  <div class="blog-sidebar-title">
    <div class="blog-sidebar-title-text <?php if (is_date()) { echo 'active-sidebar-title'; } ?>">Dates</div>
    <i class="fa <?php if (is_date()) { echo 'fa-caret-down'; } else { echo 'fa-caret-right'; } ?>"></i>
  </div>
  <div class="blog-categories <?php if (is_date()) { echo 'active-category'; } ?>">
    <ul class="">
    <?php //add_filter("get_archives_link", "get_archives_link_mod");?>
    <?php 


    $date_args = array(
      'type'            => 'monthly',
      'limit'           => '',
      'format'          => 'list', 
      'before'          => '<li>',
      'after'           => '</li>',
      'show_post_count' => false,
      'echo'            => 1,
      'order'           => 'DESC',
      'post_type'     => 'post'
    );

    //var_dump($args);
    //$archives = get_posts( $date_args ); 
    //var_dump($archives);
    
    wp_get_archives($date_args);
    //var_dump($archives);
    //var_dump(get_month_link());
    //$month = get_month_link($args);
    //var_dump($month);

    ?>
</ul>
  </div>
</div>
