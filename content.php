<?php global $i; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-item-'.$i.' post-content'); ?>>
  <?php if( in_array( get_post_format(), array('aside','standard',''))){wordstar_post_thumbnail('wordstar-post-big');} ?>
  <header class="entry-header"><?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );?></header>
  <?php 
  if( in_array( get_post_format(), array('aside','standard',''))){?>
  <div class="entry-summary"><?php the_excerpt(); ?></div>
  <?php }else {?>
  <div class="entry-content">
    <?php
    the_content( sprintf(__( 'Continue Reading %s', 'wordstar' ),the_title( '<span class="screen-reader-text">', '</span>', false )) );
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
  <?php } ?>
  <footer class="entry-footer">
    <?php wordstar_entry_meta(); ?>
    <div class="clear"></div>
  </footer>
</article>