<div class="clear"></div>
</div>
<footer id="colophon" class="site-footer " role="contentinfo">
  <div class="site-info wrapper">
    <?php
  if (has_nav_menu('footer')) {
					wp_nav_menu(array( 
					'theme_location' => 'footer', 
					'container' => false, 
					'menu_id' => 'footer-nav', 
					'menu_name' => 'footer_nav', 
					'menu_class' => 'footer-nav ', 
					'link_before' => '<span>', 
					'link_after' => '</span>',
					'fallback_cb'=>false,
					'depth'=>1
				));
			}?>
    <p class="site-info centertext footer-copy"> <span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">&copy; <?php echo date('Y');?> <?php bloginfo( 'name' ); ?></a></span> <span class="site-title"><a href="<?php echo esc_url( __( 'https://wordpress.org/', 'wordstar' ) ); ?>"> <?php printf( __( 'Proudly powered by %s', 'wordstar' ), 'WordPress' ); ?></a></span> <a href="<?php echo esc_url( __( 'http://linesh.com/', 'wordstar' ) ); ?>"> <?php printf( __( 'Theme by %s', 'wordstar' ), 'Linesh Jose' ); ?></a> </p>
  </div>
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>