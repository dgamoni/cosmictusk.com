<?php
/**
 * Register widgetized areas
 *
 */


function KTT_widgets_init() {

	register_sidebar( array(
		'id' 								=> 'main-sidebar-area',
		'name' 							=> 'Main Sidebar Area',
		'description'   		=> __('The widgets introduced in this área appear on the sidebar in every page. Use this area to display the most popular widgets of the site such as the search widget or the main navigation menu widget.', THEME_TEXTDOMAIN),
		'before_widget' 		=> '<div id="%1$s" class="padding-both-20 border-radius-3 site-palette-yin-1-background-color widget %2$s">',
		'after_widget' 			=> '</div>',
		'before_title' 			=> '<h2 class="site-palette-3-yin-color typo-size-xxsmall widget-title rounded">',
		'after_title' 			=> '</h2>',
	) );

}
add_action( 'widgets_init', 'KTT_widgets_init' );




?>
