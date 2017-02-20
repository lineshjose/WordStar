<?php get_header(); ?>
<main id="main" class="site-main content-area full-width" role="main">
  <?php while ( have_posts() ) : the_post();?>
  <article id="post-<?php the_ID(); ?>" <?php post_class('post-content'); ?>>
    <header class="entry-header"><?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' );?></header>
    <?php  wordstar_post_thumbnail('wordstar-post-wide');  ?>
    <footer class="entry-footer">
      <?php wordstar_entry_meta(); ?>
      <div class="clear"></div>
      </footer>
      <div class="entry-content">
        <?php
                /* translators: %s: Name of current post */
                the_content( sprintf(__( 'Continue reading %s', 'wordstar' ),the_title( '<span class="screen-reader-text">', '</span>', false )) );
                wp_link_pages( array(
                    'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'wordstar' ) . '</span>',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                    'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'wordstar' ) . ' </span>%',
                    'separator'   => '<span class="screen-reader-text">, </span>',
                ) );
            ?>
        <div class="clear"></div>
      </div>
  </article>
  <?php	endwhile; ?>
</main>
<?php get_footer(); ?>