<?php
/**
 * Plugin Name: WP Rocket | Hosting Inc. Compatibility
 * Description: Disable WP Rocket page cache while still use the other features.
 * Author:      WP Rocket Support Team
 * Author URI:  http://wp-rocket.me/
 * License:     GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Copyright SAS WP MEDIA 2019
 */


namespace WP_Rocket\Helpers\disable_page_caching;

// Standard plugin security, keep this line in place.
defined( 'ABSPATH' ) or die();


/**
 * Managed Hosting Inc. offers its own caching system. 
 * To prevent any incompatibility we disable WP Rocket page cache but we'll still use the other features.
 */
 
function disable_page_caching() {
	
	add_filter( 'do_rocket_generate_caching_files', '__return_false' );

}
	
add_filter( 'init', __NAMESPACE__ . '\disable_page_caching' );


