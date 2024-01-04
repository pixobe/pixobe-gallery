<?php


define("PIXOBE_GALLERY_DATA_KEY", "PIXOBE_GALLERY_DATA_KEY");

/**
 * 
 */
function pixobe_gallery_update_images($request)
{
    $request_body = $request->get_body();
    $data = json_decode($request_body, true);
    $index = $data['id'];
    if (!isset($index)) {
        $current_index =  get_option(PIXOBE_GALLERY_DATA_KEY, false);
        if ($current_index == false) {
            add_option(PIXOBE_GALLERY_DATA_KEY,  1);
            $current_index = 0;
        }
        $next_index = $current_index + 1;
        $option_key = "PIXOBE_GALLERY_ID_$next_index";
        $data["id"] = $next_index;
        add_option($option_key, json_encode( $data));
    } else {
        $option_key = "PIXOBE_GALLERY_ID_$index";
        update_option($option_key, $request_body);
    }
    return rest_ensure_response($data);
}


/**
 * 
 */
function pixobe_gallery_get_gallery($request)
{
    $id = $request['id'];
    $option_key = "PIXOBE_GALLERY_ID_$id";

    $data = get_option($option_key, false);

    if ($data == false) {
        return rest_ensure_response(array("message" => "No Data found."));
    }
    return rest_ensure_response(json_decode($data));
}

/**
 * 
 */
function register_pixobe_gallery_rest_endpoints()
{
    register_rest_route('pixobe-gallery/v1', '/gallery/', array(
        'methods' => 'POST',
        'callback' => 'pixobe_gallery_update_images',
    ));

    register_rest_route('pixobe-gallery/v1', '/gallery/(?P<id>\d+)', array(
        'methods'  => 'GET',
        'callback' => 'pixobe_gallery_get_gallery',
        'args'     => array(
            'id' => array(
                'validate_callback' => function ($param, $request, $key) {
                    return is_numeric($param);
                },
                'required'          => true,
                'sanitize_callback' => 'absint',
            ),
        ),
    ));
}
