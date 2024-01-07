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

		$page_title = 'Pixobe Coloring';

		// Updated code using WP_Query
		$args = array(
			'post_type' => 'page',
			'post_status' => 'publish',
			'name' => $page_title, // or use 'pagename' => 'your-page-slug',
		);

		$query = new \WP_Query($args);

		if (!$query->have_posts()) {
			$page_id = wp_insert_post(array(
				'post_title'     => $page_title,
				'post_type'      => 'page',
				'post_status'    => 'publish',
				'page_template'  => trailingslashit(plugin_dir_path(__FILE__)) . 'views/coloring-template.php', // Use the custom template
			));
		} 
		
	}
}
