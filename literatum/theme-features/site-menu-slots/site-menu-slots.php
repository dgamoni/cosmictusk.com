<?php
/**
 * WP3.0 menu support
 *
 *
 * @package Amanda
 */

add_action( 'init', 'KTT_menus' );
function KTT_menus() {

		// Main Menu
		register_nav_menu( 'main-menu', __( 'Primary Menu', THEME_TEXTDOMAIN ) ); // main menu - this menu appear in the top-right corner

  	// bottom menu
  	register_nav_menu( 'bottom-menu', __( 'Sidebar Bottom Menu', THEME_TEXTDOMAIN ) ); // bottom menu - this menu appear in the bottom-right corner


}
?>
