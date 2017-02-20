<?php
// Adding body class --------------->
	add_filter( 'body_class', 'wordstar_body_classes' );
	function wordstar_body_classes( $classes ) {
		if ( get_background_image() ) { // Adds a class of custom-background-image to sites with a custom background image.
			$classes[] = 'custom-background-image';
		}
		if ( is_multi_author() ) { // Adds a class of group-blog to sites with more than 1 published author.
			$classes[] = 'group-blog';
		}
		if ( ! is_active_sidebar( 'sidebar-1' ) ) {// Adds a class of no-sidebar to sites without active sidebar.
			$classes[] = 'no-sidebar';
		}
		if ( ! is_singular() ) {// Adds a class of hfeed to non-singular pages.
			$classes[] = 'hfeed';
		}
		return $classes;
	}


// Handles JavaScript detection.Adds a `js` class to the root `<html>` element when JavaScript is detected. --------------->
	add_action( 'wp_head', 'wordstar_javascript_detection', 0 );
	function wordstar_javascript_detection() {
		echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
	}


// Add a `screen-reader-text` class to the search form's submit button. --------------->
	add_filter( 'get_search_form', 'wordstar_search_form_modify' );
	function wordstar_search_form_modify( $html ) {
		return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
	}


// Post entery metas --------------->
	function wordstar_entry_meta(){
	
	// sticky post ------------->	
		if ( is_sticky() && is_home() && ! is_paged() ) {
			printf( '<span class="item sticky-post">%s</span>', __( 'Featured', 'wordstar' ) );
		}
	
	// post format ------------->
		$format = get_post_format();
		if ( current_theme_supports( 'post-formats', $format ) ) {
			printf( '<span class="item entry-format '.$format.'">%1$s<a href="%2$s" title="'.esc_attr($format).' post">%3$s</a></span>',
			  sprintf( '<span class="screen-reader-text">%s </span>', _x( 'Format', 'Used before post format.', 'wordstar' ) ),
			  esc_url( get_post_format_link( $format ) ),
			  get_post_format_string( $format )
			);
		}
	
	// Time ------------->
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		$time_string = sprintf( $time_string,
		  esc_attr( get_the_date( 'c' ) ),
		  get_the_date(),
		  esc_attr( get_the_modified_date( 'c' ) ),
		  get_the_modified_date()
		);
		printf( '<span class="item posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
		  _x( 'Posted on', 'Used before publish date.', 'wordstar' ),
		  esc_url( get_permalink() ),
		  $time_string
		);
	
	// Author ---->
		printf( '<span class=" byline"><span class="item author vcard"><span class="screen-reader-text">%1$s </span><a class="url fn n" href="%2$s">%3$s</a></span></span>',
				  _x( 'Author', 'Used before post author name.', 'wordstar' ),
				  esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				  get_the_author()
		);
	  
	// categories ---->
		$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'wordstar' ) );
		if ( $categories_list && wordstar_categorized_blog() ) {
		  printf( '<span class="item cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
			  _x( 'Categories', 'Used before category names.', 'wordstar' ),
			  $categories_list
		  );
		}
	
	// tags ---->
		$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'wordstar' ) );
		if ( $tags_list ) {
		  printf( '<span class="item tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
			  _x( 'Tags', 'Used before tag names.', 'wordstar' ),
			  $tags_list
		  );
		}
	
	// attachemnt ---->
	if ( is_attachment() && wp_attachment_is_image() ) {
		// Retrieve attachment metadata.
		$metadata = wp_get_attachment_metadata();
		printf( '<span class="item full-size-link">
		  <span class="screen-reader-text">%1$s </span><a href="%2$s">%3$s &times; %4$s</a></span>',
		  _x( 'Full size', 'Used before full size attachment link.', 'wordstar' ),
		  esc_url( wp_get_attachment_url() ),
		  $metadata['width'],
		  $metadata['height']
		);
	}
	
	// Comments ---->
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="item comments-link">';
			comments_popup_link( sprintf( __( 'Leave a comment<span class="screen-reader-text"> on %s</span>', 'wordstar' ), get_the_title() ) );
			echo '</span>';
		}
		
		edit_post_link( __( 'Edit', 'wordstar' ), '<span class="item edit-link">', '</span>' ); 
	}
	
	function wordstar_categorized_blog()
	{
		if ( false === ( $all_the_cool_cats = get_transient( 'wordstar_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( array(
			  'fields'     => 'ids',
			  'hide_empty' => 1,
			  'number'     => 2,
			) );
			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );
			set_transient( 'wordstar_categories', $all_the_cool_cats );
		}
		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so wordstar_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so wordstar_categorized_blog should return false.
			return false;
		}
	}
	function wordstar_category_transient_flusher() {
		delete_transient( 'wordstar_categories' );
	}
	add_action( 'edit_category', 'wordstar_category_transient_flusher' );
	add_action( 'save_post',   'wordstar_category_transient_flusher' );


// Post featured image --------------->
	function wordstar_post_thumbnail($size=''){
		$size=trim($size);
		if(has_post_thumbnail()){ 
			echo '<div class="post-thumbnail"><a class="" href="'.get_the_permalink().'" aria-hidden="true">';
			the_post_thumbnail( $size, array( 'alt' => get_the_title() ) );
			echo '</a></div>';
		}
	}


// Excerpt more --------------->
	add_filter( 'excerpt_more', 'wordstar_excerpt_more' );
	function wordstar_excerpt_more( $more ) {
		if(! is_admin()){
			$link = sprintf( '<a href="%1$s" class="more-link read-more" rel="bookmark">%2$s</a>',esc_url( get_permalink( get_the_ID() ) ),sprintf( __( 'Continue Reading %s', 'wordstar' ), '<span class="screen-reader-text">'.get_the_title( get_the_ID() ).'</span><i class="fa fa-arrow-right"></i>' ));
			return '&hellip; ' . $link;
		}
	}

// Excerpt character length --------------->
	add_filter( 'excerpt_length', 'wordstar_custom_excerpt_length', 999 );
	function wordstar_custom_excerpt_length( $length ) {
		return 50;
	}


// home page validation --------------->
	function wordstar_is_home_page(){
		if ( is_home() && is_front_page()) { 
			return true;
		}else{
			return false;	
		}

	}

// Displays the optional custom logo --------------->
	function wordstar_the_custom_logo() 
	{

		if ( function_exists( 'the_custom_logo' )  && has_custom_logo() ) {

				echo ' <div class="site-branding logo-active">';
				the_custom_logo();
			}else{
				echo ' <div class="site-branding">';
				if(wordstar_is_home_page()){
					echo '<h1 class="site-title"><a href="'.esc_url( home_url( '/' ) ).'" rel="home">'.get_bloginfo( 'name' ).'</a></h1>';
				} else{
					echo '<p class="site-title"><a href="'.esc_url( home_url( '/' ) ).'" rel="home">'.get_bloginfo( 'name' ).'</a></p>';
				}
			}
			
			if ( $description = get_bloginfo( 'description', 'display' )){
	       		if( !is_customize_preview()){
					$class="says";
				}
				echo '<p class="site-description '.$class.'">'.$description.'</p>';
       		}
      		echo '</div>';
		}


//  Adds postMessage support for site title and description for the Customizer. --------------->
	function wordstar_customize_partial_blogname() {bloginfo( 'name' );}
	function wordstar_customize_partial_blogdescription() {bloginfo( 'description' );}
	add_action( 'customize_register', 'wordstar_customize_register', 11 );
	function wordstar_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'blogname', array(
				'selector' => '.site-title a',
				'container_inclusive' => false,
				'render_callback' => 'wordstar_customize_partial_blogname',
			) );
			$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
				'selector' => '.site-description',
				'container_inclusive' => false,
				'render_callback' => 'wordstar_customize_partial_blogdescription',
			) );
		}
	}
	
// Author's meta ----------------> 	
	function wordstar_author_metas($author_id)
	{
		echo '<div class="author-metas">';
		
		if($post_count=count_user_posts($author_id)) { 
			echo '<a href='.esc_url(get_author_posts_url($author_id)).' title="'.esc_attr($post_count).' '.esc_attr('Posts', 'wordstar' ).'" class="posts"><i class="fa fa-thumb-tack"></i><span>'.$post_count.'</span></a>';
		}
		if($website=esc_url(get_the_author_meta('url',$author_id)) ){
			 echo '<a href="'.$website.'" rel="noopener" target="_blank" class="social web" title="'. esc_attr( 'Author\'s Website', 'wordstar' ).'"><i class="fa fa-globe"></i><span>'. __( 'Website', 'wordstar' ).'</span></a>';
		}
		echo '<a href="'.esc_url(get_author_feed_link($author_id )).'" rel="noopener"  title="'.esc_attr( 'Subscribe RSS Feed', 'wordstar' ).'" target="_blank" class="social rss"><i class="fa fa-rss"></i><span>'. __( 'RSS Feed', 'wordstar' ).'</span></a>';
		echo '<div class="clear"></div>
		</div>';
	}
add_filter('get_the_archive_title','wordstar_filter_archive_title');	
function wordstar_filter_archive_title($title )
{
	$rss='';
	if (is_search()){
		$title = '<span>'. __( 'Searching for:','wordstar' ).'</span><strong>"'.get_search_query().'"</strong>' ;
	}elseif ( is_category() ) {
		$title = '<strong>'.single_cat_title( '', false ).'</strong><span>'. __( 'Category','wordstar' ).'</span>' ;
		$rss=get_category_feed_link(get_query_var('cat'));
	} elseif ( is_tag() ) {
		$title = '<strong>'.single_tag_title( '', false ).'</strong><span>'. __( 'Tag Archive','wordstar' ).'</span>' ;
		$rss=get_tag_feed_link(get_query_var('tag_id')); 
	} elseif ( is_author() ) {
		$title = '<strong class="vcard">' . get_the_author() . '</strong><span>'. __( 'Author','wordstar' ).'</span>' ;
		$rss= get_author_feed_link(get_the_author_meta('ID'));
	} elseif ( is_year() ) {
		$title = '<strong>' .get_the_date( __( 'Y', 'wordstar' ) )  . '</strong><span>'. __( 'Yearly Archives','wordstar' ).'</span>' ;
	} elseif ( is_month() ) {
		$title = '<strong>' .get_the_date( __( 'F Y', 'wordstar' ) )  . '</strong><span>'. __( 'Monthly Archives ','wordstar' ).'</span>' ;
	} elseif ( is_day() ) {
		$title = '<strong>' .get_the_date( __( 'F j, Y', 'wordstar' ) )  . '</strong><span>'. __( 'Daily Archives','wordstar' ).'</span>' ;
	} elseif ( is_post_type_archive() ) {
		$title = '<strong>' .post_type_archive_title( '', false )  . '</strong>' ;
		$rss=get_post_type_archive_feed_link(get_query_var('post_type'));
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$title = '<strong>'.single_term_title('', false ).'</strong><span>'.$tax->labels->singular_name.'</span>' ;
		$rss=get_term_feed_link($term->term_id, get_query_var( 'taxonomy' ));
	 } else {
		$title = '' ;//__( '<span>BLog Archives:</span> <strong>All Posts</strong>' );
		$rss=bloginfo('rss2_url');
	}
	if($title && $rss){
		$title=$title.'<a href="'.$rss.'" title="'.esc_attr(__('Subscribe this','wordstar')).'" class="subscribe" rel="noopener noreferrer" target="_blank"><i class="fa fa-rss"></i><srong class="">'.__('Subscribe','wordstar').'</srong></a>	';
	}
	return $title;
}
?>