<?php

namespace PixobeGallery\Plugins;


use PixobeGallery\Plugins\PixobeGalleryConstants;

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
class Pixobe_Gallery_Utils
{

    public static function get_gallery($id)
    {

        $option_data = get_option(PixobeGalleryConstants::PIXOBE_GALLERY_OPT_KEY, false);

        if ($option_data != false) {

            $data = json_decode($option_data, true);

            return $data[$id];
        }
        return null;
    }

    public static function add_or_update($gallery_data, $id)
    {

        $data = get_option(PixobeGalleryConstants::PIXOBE_GALLERY_OPT_KEY, false);

        if ($data != false) {

            $opt = json_decode($data, true);

            if (!$id) {
                $id = count($opt) + 1;
            }

            $opt[$id] = $gallery_data;

            update_option(PixobeGalleryConstants::PIXOBE_GALLERY_OPT_KEY, json_encode($opt));

            return array("id"=>$id);
        }
        return null;
    }
}
