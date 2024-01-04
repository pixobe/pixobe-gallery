<?php
/**
 * Plugin Name: 	Pixobe Gallery
 * Plugin URI:		https://pixobe.com/
 * Description:		Media Gallery plugin with customer actions
 * Version: 		0.0.1
 * Author: 			Pixobe
 * Author URI: 		https://pixobe.com/
 */

function pixobe_gallery() {

    wp_enqueue_media();
    
    add_menu_page(
        'Pixobe Gallery',
        'Pixobe Gallery',
        'manage_options',
        'pixobe-gallery',
        'pixobe_gallery_page', // Callback function for the page content
        'dashicons-admin-plugins',
        20
    );

    add_submenu_page(
        'pixobe-gallery',
        'Galleries',
        'Galleries',
        'manage_options',
        'pixobe-gallery-list',
        'pixobe_gallery_list_page'
    );
}

// Register the custom admin menu
add_action('admin_menu', 'pixobe_gallery');

// Callback function for the main admin page
function pixobe_gallery_page() {
   require_once(__DIR__."/views/home.php");
}


/**
 * 
 */
function enquue_pixobe_gallery_scripts(){

    wp_enqueue_script(
       'pixobe-gallery-scripts',
    //    trailingslashit(plugin_dir_url(__FILE__)). "build/static/js/main.71d77bf0.js",
    "http://localhost:3000/static/js/bundle.js",
        array('jquery'),
        '1.0',
        true
    );
}

 function add_filter_pixobe_gallery_scripts($tag, $handle, $src)
{
    if ('pixobe-gallery-scripts' === $handle) {
        return wp_get_script_tag(
            array(
                'src'  => $src,
                'type' => 'module',
                "defer" => true
            )
        );
    }
    return $tag;
}

add_action('wp_enqueue_scripts', 'enquue_pixobe_gallery_scripts', 5);
add_action('admin_enqueue_scripts', 'enquue_pixobe_gallery_scripts', 5);
add_filter('script_loader_tag', 'add_filter_pixobe_gallery_scripts', 10, 3);