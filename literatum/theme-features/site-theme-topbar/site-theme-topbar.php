<?php
/**
* Este script se encarga de añadir una topbar a nuestro sitio que utilizaremos
* como ayuda de interfaz para la navegacion general en la web, aquí podrán integrarse
* elementos de navegación y logos, ayudas, etc
*/




/**
* esta funcion genera el layout de la topbar
*/
function KTT_theme_topbar_layout() {
    ?>
    <div
    class="text-align-center site-palette-yang-1-color"
    id="site-header-wrap">

      <div
      id="site-header"
      layout-padding
      layout-align="space-between center"
      class="text-align-left margin-auto max-width-1000px"
      style="margin:auto;max-height:100px;"
      layout="row">

        <?php do_action('KTT_add_theme_topbar_field');?>

      </div>

    </div>
    <?php
}






/**
* Esta funcino se encarga de añadir el logo al topbar
*/
function KTT_theme_topbar_site_logo() {
    /**
    * Obtenemos la url del logo
    */
    $logo_image_url = KTT_get_site_logo_url('full');

    ?>
    <div flex="auto" layout="row" layout-align="start center">

        <a href="<?php echo home_url();?>"  class="display-block button-behaviour margin-right-20">
        <?php
        if ($logo_image_url) {
          ?>
          <img
          alt="<?php bloginfo('name');?>"
          class=""
          width="auto"
          style="vertical-align: middle;max-height:70px"
          src="<?php echo $logo_image_url;?>">
          <?php
        } else {
          echo  '<span class=" typo-size-xxlarge site-tipeface-title-2">' . bloginfo('name') . '</span>';
        }
        ?>
        </a>
        <?php



        $website_slogan = get_option(ktt_var_name('website_slogan'));
        if ($website_slogan) {?>
        <div md-truncate hide-xs flex="auto" class="max-width-300px typo-size-xsmall ogo-legend">
          <?php echo wpautop($website_slogan);?>
        </div>
        <?php } ?>

    </div>
    <?php


}
add_action('KTT_add_theme_topbar_field', 'KTT_theme_topbar_site_logo', 1);






/**
* Esta funcino se encarga de añadir el logo al topbar
*/
function KTT_theme_topbar_site_menu() {
    /**
    * Obtenemos la url del logo
    */
    $logo_image_url = get_site_icon_url('small',KTT_get_site_logo_url('small'));
    ?>

    <div
    flex="auto"
    class="text-align-right"
    layout-align="end center"
    layout="row">


      <?php if ( has_nav_menu( 'main-menu' ) ) {?>

          <div hide-xs class="link-white-color margin-right-10 typo-size-small menu-site-menu-container">
          <?php wp_nav_menu(
            array(
              'theme_location' => 'main-menu',
              'menu_class' => 'main-menu display-inline',
            )); ;?>
          </div>

      <?php } ?>


      <md-button onclick="pushmenu()" class="md-fab md-primary" md-colors="{background: 'grey-A100'}" aria-label="Open menu">
          <md-icon md-colors="{color: 'grey-A700'}"><i style="vertical-align:middle;vertical-align:1em;font-size:24px;" class=" material-icons">menu</i></md-icon>
      </md-button>

    </div>
  <?php

}
add_action('KTT_add_theme_topbar_field', 'KTT_theme_topbar_site_menu', 1);






/**
* Esta funcion general el layout general de la topbar
*/
function KTT_add_site_topbar() {

    /*+
    * Si estamos en un 404 nanay
    */
    if (is_404()) return;

    /**
    * Llamamos a la funcino que se encarga de generar el layout
    */
    KTT_theme_topbar_layout();

}
add_action('KTT_theme_body_start', 'KTT_add_site_topbar', 5);
 ?>
