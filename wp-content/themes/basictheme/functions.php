<?php
/*
============================================================

This function adds the custom JavaScript and CSS files to your custom theme 

============================================================
*/

function basic_script_enqueue() {
    wp_enqueue_style('customstyle', get_template_directory_uri() . '/css/basictheme.css', array(), '1.0.0', 'all');
    wp_enqueue_style('normalize', get_template_directory_uri() . '/css/normalize.css', array(), '1.0.0', 'all');
    wp_enqueue_style('customstyle-2', get_template_directory_uri() . '/style.css', array(), '1.0.0', 'all');
    wp_enqueue_script('customjs', get_template_directory_uri() . '/js/basictheme.js', array(), '1.0.0', true);
    wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/bootstrap-custom.css', array(), '1.0.0', 'all');
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/bootstrap/dist/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/bootstrap/dist/js/bootstrap.min.js');
}

// This calls the above function 
add_action('wp_enqueue_scripts', 'basic_script_enqueue');
/*
============================================================

This function adds the menus to your theme allowing for mutiple menus

============================================================
*/
function basic_theme_setup() {
    
    add_theme_support('menus');
    register_nav_menu('primary', 'Primary Header Navigation');
    register_nav_menu('footer', 'Footer Navigation');    
    register_nav_menu('mobile', 'Mobile Navigation');    
}
/*
============================================================

This activates the custom features

============================================================
*/

add_action('init', 'basic_theme_setup');
add_theme_support('custom-background');
add_theme_support('custom-header');
add_theme_support('post-thumbnails');
?>