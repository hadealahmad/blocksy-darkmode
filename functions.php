<?php

// Enqueue the custom color switch JavaScript
function my_enqueue_custom_color_switch_js() {
$version = get_option('my_custom_css_version');
  wp_enqueue_script('blocksy-darkmode-js', plugins_url('/blocksy-darkmode.js', __FILE__), array('jquery'), $version, true);

}
add_action('wp_enqueue_scripts', 'my_enqueue_custom_color_switch_js');
function enable_plugin_css_block() {
$version = get_option('my_custom_css_version');
    wp_enqueue_style( 'blocksy-darkmode-css', plugins_url( '/blocksy-darkmode.css', __FILE__ ), array(), $version, false);
}
add_action('wp_enqueue_scripts', 'enable_plugin_css_block');

if ($_COOKIE['dark_mode']==='true') {
function enable_css_block() {
    $version = get_option('my_custom_css_version');
    wp_enqueue_style( 'blocksy-darkmode-colors-css', plugins_url( '/blocksy-darkmode-colors.css', __FILE__ ), array(), $version, false);
}

add_action('wp_enqueue_scripts', 'enable_css_block');

} 
if ($_COOKIE['dark_mode']==='false') {
function disable_css_block() {
    wp_dequeue_style('blocksy-darkmode-colors-css');
}

add_action('wp_enqueue_scripts', 'disable_css_block');
}