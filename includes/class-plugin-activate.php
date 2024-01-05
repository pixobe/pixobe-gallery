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
class Pixobe_Gallery_Activator
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate()
	{
		// generate a random secret for jwt
		add_option(PixobeGalleryConstants::PIXOBE_GALLERY_OPT_KEY, json_encode([]));
	}


}
