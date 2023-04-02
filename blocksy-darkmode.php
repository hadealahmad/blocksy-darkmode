<?php
/**
 * Plugin Name: Blocksy Darkmode
 * Plugin URI: http://hadealahmad.com
 * Description: Adds a second color palette and switcher to front end to switch between the default blocksy color palette and the second palette.
 * Version: 1.0.1
 * Author: Hadi Ahmet
 * Author URI: http://hahdealahmad.com/
 * License: GPL2
 **/
require_once(plugin_dir_path(__FILE__) . 'functions.php');

function my_customizer_settings($wp_customize) {

  // Add a new section for color palette settings
  $wp_customize->add_section('my_color_palette_section', array(
    'title' => __('Color Palette Settings', 'darkmode-blocksy'),
    'priority' => 30
  ));

  // Add a new setting for each color in the palette

  $color_choices = array(
    'paletteColor1' => __('paletteColor1', 'darkmode-blocksy'),
    'paletteColor2' => __('paletteColor2', 'darkmode-blocksy'),
    'paletteColor3' => __('paletteColor3', 'darkmode-blocksy'),
    'paletteColor4' => __('paletteColor4', 'darkmode-blocksy'),
    'paletteColor5' => __('paletteColor5', 'darkmode-blocksy'),
    'paletteColor6' => __('paletteColor6', 'darkmode-blocksy'),
    'paletteColor7' => __('paletteColor7', 'darkmode-blocksy'),
  	'paletteColor8' => __('paletteColor8', 'darkmode-blocksy'),
  );

  foreach ($color_choices as $color_name => $color_label) {
    $wp_customize->add_setting($color_name, array(
      'default' => '#ffffff',
      'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $color_name, array(
      'label' => $color_label,
      'section' => 'my_color_palette_section',
      'settings' => $color_name,
    )));
  }
}

add_action('customize_register', 'my_customizer_settings');

function my_generate_css_code() {

  // Get the 7 color choices from the Customizer settings
  $color_choices = array(
    'paletteColor1' => get_theme_mod('paletteColor1', '#ffffff'),
    'paletteColor2' => get_theme_mod('paletteColor2', '#ffffff'),
    'paletteColor3' => get_theme_mod('paletteColor3', '#ffffff'),
    'paletteColor4' => get_theme_mod('paletteColor4', '#ffffff'),
    'paletteColor5' => get_theme_mod('paletteColor5', '#ffffff'),
    'paletteColor6' => get_theme_mod('paletteColor6', '#ffffff'),
    'paletteColor7' => get_theme_mod('paletteColor7', '#ffffff'),
  	'paletteColor8' => get_theme_mod('paletteColor8', '#ffffff'),
  );

  // Build the CSS code using the color choices
  $css_code = '';

  foreach ($color_choices as $color_name => $color_value) {
    $css_code .= sprintf('--%s: %s!important;', $color_name, $color_value) . "\n";
  }

  // Return the CSS code
  return sprintf('%s', $css_code);
}
function my_plugin_echo_css() {
    $css = "*{".my_generate_css_code()."}";
    $file = plugin_dir_path(__FILE__) . 'blocksy-darkmode-colors.css';
    $handle = fopen($file, 'w');
    fwrite($handle, $css);
    fclose($handle);

}
add_action('customize_save_after', 'my_plugin_echo_css');
function my_output_temp_css() {
  $css_code = my_generate_css_code();
  echo "<style type='text/css'>.temp-enable-css{".$css_code."}</style>";
}
add_action('wp_head', 'my_output_temp_css');



function my_generate_css_version_on_save() {
    $new_version = time(); // or any other logic to generate a unique version number
    update_option('my_custom_css_version', $new_version);
}

// Hook the function to the customize_save_after hook
add_action('customize_save_after', 'my_generate_css_version_on_save');


// Add a shortcode to display the custom color switch
function my_custom_color_switch_shortcode() {
  $output = '<label class="switch slider " for="my-switch-toggle">
  <input type="checkbox" id="my-switch-toggle">
  <span class="slider round"></span>
</label>
';

  return $output;
}
add_shortcode('my_custom_color_switch', 'my_custom_color_switch_shortcode');
