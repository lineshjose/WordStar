<?php 
/* Template Name: Archives */
get_header(); ?>
<main id="main" class="site-main content-area archives" role="main">
  <?php 
	if ( have_posts() ) : 
	if(is_author()){
?>
  <header class="page-header">
    <div class="author-info">
      <div class="author-avatar"> <?php echo get_avatar(get_the_author_meta('user_email'), apply_filters( 'linesh_author_bio_avatar_size',100) );?> </div>
      <div class="author-description">
        <h1 class="author-title"><?php echo get_the_author_meta('display_name');?></h1>
        <div class="author-bio"><?php echo get_the_author_meta('description');?></div>
        <?php wordstar_author_metas(get_the_author_meta('ID')); ?>
      </div>
      <div class="clear"></div>
    </div>
    <h3 class="page-title screen-reader-text"><?php echo get_the_author_meta('display_name');?> <?php _e( '\'s Posts', 'wordstar' );?></h3>
  </header>
  <?php }else if ( !is_home() && !is_front_page() ){?>
  <header class="page-header">
    <?php if(is_search()) {?>
    	<h1 class="page-title"><?php printf( __( 'Searching for: "%s"', 'wordstar' ), get_search_query() );?></h1>
    <?php }else{
          the_archive_title( '<h1 class="page-title">', '</h1>' );
          the_archive_description( '<div class="taxonomy-description">', '</div>' );
      } ?>
  </header>
  <?php
	}
	while ( have_posts() ) : the_post();
		get_template_part( 'content');
	endwhile;
	// Pagination
	the_posts_pagination( array(
				'mid_size' => 5,
				'prev_text'          => __( 'Previous page', 'wordstar' ),
				'next_text'          => __( 'Next page', 'wordstar' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'wordstar' ) . ' </span>',
				'screen_reader_text' =>  __( 'Pagination', 'wordstar' ) 
	) );
	else :
		get_template_part( 'content', 'none' );
	endif;
?>
  <div class="clear"></div>
</main>
<?php get_sidebar();?>
<?php get_footer(); ?>