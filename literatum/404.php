<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 */
get_header(); ?>

	<div
	class="site-palette-yin-2-color site-palette-yang-1-background-color height-100vh width-100vw"
	layout="column"
	layout-align="center center">

		<div class="typo-size-xxxxlarge font-weight-200">
			<span class="text-shadow-1 typo-size-xxxxlarge">404</span>
		</div>
		<div class="padding-top-20 typo-size-xxxlarge font-weight-200">
			<?php _e('Page not found.', THEME_TEXTDOMAIN);?>
		</div>

		<div class="padding-top-40 typo-size-small font-weight-400">
			<a href="<?php echo home_url();?>">
				<i class="material-icons">call_missed</i> <?php echo sprintf(__('Go back to a %s.', THEME_TEXTDOMAIN), get_bloginfo('name'));?>
			</a>
		</div>
	</div>

<?php
get_footer();
