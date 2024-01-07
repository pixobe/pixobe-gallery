<?php

/**
 * Plugin Name: 	Pixobe Gallery
 * Plugin URI:		https://pixobe.com/
 * Description:		Media Gallery plugin with customer actions
 * Version: 		0.0.1
 * Author: 			Pixobe
 * Author URI: 		https://pixobe.com/
 */

 require trailingslashit(plugin_dir_path(__FILE__)) . 'functions.php';

require trailingslashit(plugin_dir_path(__FILE__)) . 'includes/class-plugin-constants.php';
require trailingslashit(plugin_dir_path(__FILE__)) . 'includes/class-plugin-utils.php';
require trailingslashit(plugin_dir_path(__FILE__)) . 'includes/class-plugin-activate.php';
require trailingslashit(plugin_dir_path(__FILE__)) . 'includes/class-plugin-rest.php';



use PixobeGallery\Plugins\Pixobe_Gallery_Activator;

function pixobe_gallery()
{

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



// Callback function for the main admin page
function pixobe_gallery_page()
{
    require_once(__DIR__ . "/views/home.php");
}

function pixobe_gallery_list_page(){
    require_once(__DIR__ . "/views/galleries.php");
}

/**
 * 
 */
function enquue_pixobe_gallery_scripts()
{
    wp_enqueue_script(
        'pixobe-gallery-scripts',
           trailingslashit(plugin_dir_url(__FILE__)). "build/static/js/main.js",
        array('jquery'),
        '1.0',
        true
    );

    wp_enqueue_style('pixobe-gallery-style', trailingslashit(plugin_dir_url(__FILE__)). "build/static/css/main.css", array(), '1.0', 'all');

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


// on activte

function pixobe_gallery_plugin_activate()
{
    Pixobe_Gallery_Activator::activate();
}


function pixobe_gallery_page_template( $page_template )
{
    if ( is_page( 'pixobe-coloring' ) ) {
        $page_template = trailingslashit(plugin_dir_path(__FILE__)) . 'views/coloring-template.php';
    }
    return $page_template;
}

function pixobe_gallery_enqueu_styles()
{
    Pixobe_Gallery_Activator::activate();
}


add_action('wp_enqueue_scripts', 'enquue_pixobe_gallery_scripts', 5);
add_action('admin_enqueue_scripts', 'enquue_pixobe_gallery_scripts', 5);
add_filter('script_loader_tag', 'add_filter_pixobe_gallery_scripts', 10, 3);
register_activation_hook(__FILE__, 'pixobe_gallery_plugin_activate');
add_filter( 'page_template', 'pixobe_gallery_page_template' );
// Register the custom admin menu
add_action('admin_menu', 'pixobe_gallery');
add_action('rest_api_init', array("PixobeGallery\Plugins\Pixobe_Gallery_Rest","init"));
