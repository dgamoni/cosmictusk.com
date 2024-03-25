<?php
/**
* Capturamos el filter de las plantillas de colores y nos encargamos
* de añadir las plantillas predeterminadas para este theme
*/
function KTT_default_theme_color_templates($templates) {

    $templates['base_light'] = array(
      'id' => 'base_light',
      'name' => 'Base Light',
      'description' => 'White and simple colors',
      'colors' => array(

          'yin' => array(
            'site_palette_yin_1' => '#27262B',
            'site_palette_yin_2' => '#474748',
            'site_palette_yin_3' => '#6C606F',
            'site_palette_yin_4' => '#99939F',
          ),

          'yin_special' => array(
            'site_palette_special_1' => '#4A3Ddd',
            'site_palette_special_2' => '#ab5d6a',
          ),

          'yang' => array(
            'site_palette_yang_1' => '#F6F9FC',
            'site_palette_yang_2' => '#F0F3F5',
            'site_palette_yang_3' => '#e2e8e9',
            'site_palette_yang_4' => '#d2d8d9',
          ),

          'yang_special' => array(
            'site_palette_special_1' => '#efe8e9',
            'site_palette_special_2' => '#dfd8d9',
          )

      )
    );

    /**
    * Plantillas
    */
    $templates['sand'] = array(
      'id' => 'sand',
      'name' => 'Sand',
      'description' => 'Light theme with browns ',
      'colors' => array(

          'yin' => array(
            'site_palette_yin_1' => '#4F3939',
            'site_palette_yin_2' => '#694C4C',
            'site_palette_yin_3' => '#916D6E',
            'site_palette_yin_4' => '#b18D8E',
          ),

          'yin_special' => array(
            'site_palette_special_1' => '#ab5d6a',
            'site_palette_special_2' => '#4A3Ddd',
          ),

          'yang' => array(
            'site_palette_yang_1' => '#FCFAF5',
            'site_palette_yang_2' => '#F8F4E9',
            'site_palette_yang_3' => '#F6F0E1',
            'site_palette_yang_4' => '#F3EAD6',
          ),

          'yang_special' => array(
            'site_palette_special_1' => '#dfd8d9',
            'site_palette_special_2' => '#efe8e9',
          )

      )
    );


    /**
    * Cremos la plantilla Default Inverse
    */
    $templates['light_blue'] = array(
      'id' => 'light_blue',
      'name' => 'Light Blue',
      'description' => 'Blue tones',
      'colors' => array(

          'yin' => array(

            'site_palette_yin_1' => '#242457',
            'site_palette_yin_2' => '#444477',
            'site_palette_yin_3' => '#666699',
            'site_palette_yin_4' => '#7356B6',
          ),

          'yin_special' => array(
            'site_palette_special_1' => '#1D1D5C',
            'site_palette_special_2' => '#24B47E',
          ),


          'yang' => array(
            'site_palette_yang_1' => '#E4ECF3',
            'site_palette_yang_2' => '#E4ECF1',
            'site_palette_yang_3' => '#CCDDEE',
            'site_palette_yang_4' => '#73A0CA',

          ),

          'yang_special' => array(
            'site_palette_special_1' => '#3ECF8E',
            'site_palette_special_2' => '#FFC300',
          ),




      )
    );

    /**
    * Por ultimo devolvemos el array modificado
    */
    return $templates;


}
add_filter('KTT_THEME_color_templates', 'KTT_default_theme_color_templates', 1, 1);
