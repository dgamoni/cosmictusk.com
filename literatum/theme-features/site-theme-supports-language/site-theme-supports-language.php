<?php
/**
*/

add_action( 'after_setup_theme', 'KTT_load_theme_languages' );
function KTT_load_theme_languages(){
    load_theme_textdomain( THEME_TEXTDOMAIN, get_template_directory() . '/languages' );
}

 ?>
