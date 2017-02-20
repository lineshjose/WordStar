<?php get_header(); ?>
<main id="main" class="site-main content-area not-found-page" role="main">
  <article class="fof-page">
    <h1 class="page-title"><?php _e( '404', 'wordstar' ); ?></h1>
    <h2 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'wordstar' ); ?></h2>
    <p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'wordstar' ); ?></p>
    <div class="search-form-wrap">
    <?php get_search_form(); ?>
    </div>
    <div class="clear"></div>
  </article>
  <div class="clear"></div>
</main>
<?php get_footer(); ?>
