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
      foreach ( $categories as $category ) {

        if (is_category( $category->name )) {
          $iscat = 'active';
        } else {
          $iscat = '';
        }

          echo '<li class="' . $iscat . '"><a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a></li>';
      }
      ?>
    </ul>
  </div>
  <div class="blog-sidebar-title">
    <div class="blog-sidebar-title-text <?php if (is_author()) { echo 'active-sidebar-title'; } ?>">Authors</div>
    <i class="fa <?php if (is_author()) { echo 'fa-caret-down'; } else { echo 'fa-caret-right'; } ?>"></i>
  </div>
  <div class="blog-categories <?php if (is_author()) { echo 'active-category'; } ?>">
    <ul>
      <?php wp_list_authors( $args ); ?>
    </ul>
  </div>
  <div class="blog-sidebar-title">
    <div class="blog-sidebar-title-text <?php if (is_date()) { echo 'active-sidebar-title'; } ?>">Dates</div>
    <i class="fa <?php if (is_date()) { echo 'fa-caret-down'; } else { echo 'fa-caret-right'; } ?>"></i>
  </div>
  <div class="blog-categories <?php if (is_date()) { echo 'active-category'; } ?>">

  </div>
</div>
