<div class="blog-sidebar">
  <div class="blog-sidebar-title">
    Categories
    <i class="fa fa-caret-right"></i>
  </div>
  <div class="blog-categories">
    <ul>
      <?php
      $args = array(
        'orderby' => 'name',
        'parent' => 0
        );
      $categories = get_categories( $args );
      foreach ( $categories as $category ) {
          echo '<li><a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a></li>';
      }
      ?>
    </ul>
  </div>
  <div class="blog-sidebar-title">
    Authors
    <i class="fa fa-caret-right"></i>
  </div>
  <div class="blog-categories">
    <ul>
      <?php wp_list_authors( $args ); ?>
    </ul>
  </div>
  <div class="blog-sidebar-title">
    Dates
    <i class="fa fa-caret-right"></i>
  </div>
  <div class="blog-categories">

  </div>
</div>
