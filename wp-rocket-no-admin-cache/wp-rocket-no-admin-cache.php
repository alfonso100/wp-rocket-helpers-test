<?php
/**
 * Plugin Name: WP Rocket | No admin cache when user cache is enabled
 * Description: Prevent caching for administrators when cache for logged-in users is enabled.
 * Author:      WP Rocket Support Team
 * Author URI:  http://wp-rocket.me/
 * License:     GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Copyright SAS WP MEDIA 2019
 */


namespace WP_Rocket\Helpers\no_admin_cache;

// Standard plugin security, keep this line in place.
defined( 'ABSPATH' ) or die();


/**
 * Prevent caching for administrators. 
 */
 
function disable_cache_for_administrators() {
	
	if (current_user_can('administrator')) {
		
		if (! defined('DONOTCACHEPAGE' )) {
			define('DONOTCACHEPAGE', true );
		}
	
		if (! defined('DONOTROCKETOPTIMIZE' )) {
			define('DONOTROCKETOPTIMIZE', true );
		}
	
	}
}
	
add_filter( 'init', __NAMESPACE__ . '\disable_cache_for_administrators' );







