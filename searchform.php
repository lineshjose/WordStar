<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'wordstar' ); ?></span> <i class="fa fa-search"></i>
  <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;',  'placeholder', 'wordstar' ); ?>" value="<?php echo get_search_query();?>" name="s" title="<?php echo esc_attr( 'Search', 'wordstar' ); ?>" required>
  <button type="submit" class="search-submit"><i class="fa fa-search"></i><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'wordstar' ); ?></span></button>
</form>