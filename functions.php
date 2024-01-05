<?php


function pixobe_gallery_shortcode($atts) {
    // You can customize the shortcode attributes if needed
    $atts = shortcode_atts(
        array(
            'id' => null,
        ),
        $atts,
        'pixobe-gallery'
    );


    ob_start();

    include  trailingslashit(plugin_dir_path(__FILE__)) . 'views/shortcode.php';

    $view_content = ob_get_clean();

    // Return the view content
    return $view_content;
}


add_shortcode('pixobe-gallery', 'pixobe_gallery_shortcode');
