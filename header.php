<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>
<?php wp_head(); ?>
<style>
<?php if(get_custom_header()) {?> 
	#masthead {
	 background-image: 	url('<?php header_image(); ?>') !important;
	 background-size:cover;
	}
<?php }
if(get_header_textcolor()) {
?> 
	#masthead .site-branding a {
	 color: 	#<?php echo get_header_textcolor();?> !important;
	}
<?php }
if ( !display_header_text() ) {?>
.site-branding,
.site-branding .site-title,
.site-description {
		clip: rect(1px, 1px, 1px, 1px)!important;
		position: absolute!important;
		margin:0px !important;
}
<?php } ?>


</style>
</head>
<body id="site-body" <?php body_class(); ?>>
<div id="page" class="site">
<a class="skip-link screen-reader-text" href="#content">
<?php _e( 'Skip to content', 'wordstar' ); ?>
</a>
<header id="masthead" class="site-header" role="banner">
  <div class="site-header-main">
    <div class="wrapper">
      <?php wordstar_the_custom_logo();  ?>
      <div class="search-form-wrap">
        <button id="search-toggle" class="search-toggle"><i class="fa fa-search"></i><span>
        <?php _e( 'Search', 'wordstar' ); ?>
        </span></button>
        <?php get_search_form();?>
      </div>
      <div id="site-header-menu" class="site-header-menu">
        <button id="menu-toggle" class="menu-toggle"><i class="fa fa-bars"></i><span>
        <?php _e( 'Menu', 'wordstar' ); ?>
        </span></button>
        <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'wordstar' ); ?>">
          <?php if (has_nav_menu('primary')) {
				wp_nav_menu(array( 
					'theme_location' => 'primary', 
					'container' => false, 
					'fallback_cb'=>false,
					'menu_id' => 'primary-menu', 
					'menu_name' => 'primary_menu', 
					'menu_class' => 'primary-menu', 
					'link_before' => '<span>', 
					'link_after' => '</span>',
					'depth'=>2
				));
			}
			?>
          <div class="clear"></div>
        </nav>
      </div>
      <div class="clear"></div>
    </div>
  </div>
  <div class="clear"></div>
</header>
<div id="content" class="site-content wrapper">