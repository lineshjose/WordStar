<?php get_header(); ?>
<main id="main" class="site-main  single-post" role="main">
  <?php while ( have_posts() ) : the_post();?>
  <article id="post-<?php the_ID(); ?>" <?php post_class('post-content'); ?>>
    <header class="entry-header">
      <?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' );?>
    </header>
    <?php if( in_array( get_post_format(), array('aside','standard','')) ){ wordstar_post_thumbnail('wordstar-post-big'); } ?>
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
      <?php
  	if ( is_singular( 'attachment' ) ) {
				// Parent post navigation.
				the_post_navigation( array(
					'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'wordstar' ),
				) );
			} elseif ( is_singular( 'post' ) ) {
				// Previous/next post navigation.
				the_post_navigation( array(
					'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'wordstar' ) . '</span> ' .
						'<span class="screen-reader-text">' . __( 'Next post:', 'wordstar' ) . '</span> ' .
						'<span class="post-title">%title</span>',
					'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'wordstar' ) . '</span> ' .
						'<span class="screen-reader-text">' . __( 'Previous post:', 'wordstar' ) . '</span> ' .
						'<span class="post-title">%title</span>',
				) );
			}
  ?>
      <div class="clear"></div>
      <div class="author-info vcard author-<?php echo esc_html(get_the_author_meta( 'ID' ));?>">
        <div class="author-avatar"> <?php echo get_avatar(get_the_author_meta('user_email'), apply_filters( 'wordstar_author_bio_avatar_size', 70 ) );?> </div>
        <div class="author-description">
          <h3 class="author-title">
            <?php _e( 'About', 'wordstar' );?>
            <strong><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta( 'ID' )));?>" title="<?php echo esc_attr( 'Posts by', 'wordstar' );?> <?php  echo get_the_author_meta('display_name');?>" rel="author" class="author url fn">
            <?php  echo esc_html(get_the_author_meta('display_name'));?>
            </a></strong></h3>
          <div class="author-bio"><?php echo esc_html(get_the_author_meta('description'));?></div>
          <?php  wordstar_author_metas(get_the_author_meta('ID')); ?>
        </div>
        <div class="clear"></div>
      </div>
      </article>
      <?php	endwhile; ?>
      <div id="comments">
        <?php if ( comments_open() || get_comments_number() ) {comments_template();}?>
      </div>
</main>
<?php get_sidebar();?>
<?php get_footer(); ?>