<?php

namespace PixobeGallery\Plugins;


use PixobeGallery\Plugins\Pixobe_Gallery_Utils;

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Woo_Flutter
 * @subpackage Woo_Flutter/includes
 * @author     Pixobe <email@pixobe.com>
 */
class Pixobe_Gallery_Rest
{


    public static function init()
    {
        register_rest_route('pixobe-gallery/v1', '/gallery(?:/(?P<id>\d+))?', array(
            'methods' => 'POST',
            'callback' => array("PixobeGallery\Plugins\Pixobe_Gallery_Rest", "update_gallery"),
            'args' => array(
                'param' => array(
                    'required' => false,
                    'validate_callback' => function($param, $request, $key) {
                        return is_numeric($param);
                    },
                    'sanitize_callback' => 'absint',
                ),
            ),
        ));

        register_rest_route('pixobe-gallery/v1', '/gallery/(?P<id>\d+)', array(
            'methods'  => 'GET',
            'callback' => array("PixobeGallery\Plugins\Pixobe_Gallery_Rest", "get_gallery"),
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


    public static function update_gallery($request)
    {
        //get id
        $id = $request->get_param("id");
        $data = $request->get_json_params();
        Pixobe_Gallery_Utils::add_or_update($data, $id);
        return rest_ensure_response(array("msg"=>"Saved successfully"));
    }

    public static function get_gallery($request)
    {
        //get id
        $id = $request['id'];
       
        $response =  Pixobe_Gallery_Utils::get_gallery($id);

        return rest_ensure_response($response);
    }
}
