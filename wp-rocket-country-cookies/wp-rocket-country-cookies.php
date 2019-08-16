<?php
/**
 * Plugin Name: WP Rocket | Country Cookie
 * Description: Deliver a different cache version based on the country, and prevent caching until the cookie is set.
 * Author:      WP Rocket Support Team
 * Author URI:  http://wp-rocket.me/
 * License:     GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Copyright SAS WP MEDIA 2019
 */


namespace WP_Rocket\Helpers\dynamic_cookie;

// Standard plugin security, keep this line in place.
defined( 'ABSPATH' ) or die();


function cookie_name() {
	
	$cookies[] = 'origin_country';
	return $cookies;
}

/**
 * Add mandatory cookie to WP Rocket config to prevent delivering a cached version until the cookie is set.
 *
 * @author Alfonso
 */

add_filter( 'rocket_cache_mandatory_cookies',  __NAMESPACE__ .'\cookie_name' );



/**
 * Define cookie ID for dynamic caches.
 *
 * @author Caspar Hübinger
 */
// Add cookie ID to cookkies for dynamic caches.
add_filter( 'rocket_cache_dynamic_cookies', __NAMESPACE__ . '\cookie_name' );
// Remove .htaccess-based rewrites, since we need to detect the cookie,
// which happens in inc/front/process.php.
add_filter( 'rocket_htaccess_mod_rewrite', '__return_false' );




/**
 * Updates .htaccess, regenerates WP Rocket config file.
 *
 * @author Caspar Hübinger
 */
 
 function flush_wp_rocket() {

	if ( ! function_exists( 'flush_rocket_htaccess' )
	  || ! function_exists( 'rocket_generate_config_file' ) ) {
		return false;
	}

	// Update WP Rocket .htaccess rules.
	flush_rocket_htaccess();

	// Regenerate WP Rocket config file.
	rocket_generate_config_file();
}


/**
 * Add customizations, updates .htaccess, regenerates config file.
 *
 * @author Caspar Hübinger
 */
 
function activate() {

	// Add customizations upon activation.
	add_filter( 'rocket_htaccess_mod_rewrite', '__return_false' );

	// Flush .htaccess rules, and regenerate WP Rocket config file.
	flush_wp_rocket();
}
register_activation_hook( __FILE__, __NAMESPACE__ . '\activate' );


/**
 * Removes customizations, updates .htaccess, regenerates config file.
 *
 * @author Caspar Hübinger
 */
 
function deactivate() {

	// Remove customizations upon deactivation.
	remove_filter( 'rocket_htaccess_mod_rewrite', '__return_false' );
	remove_filter( 'rocket_cache_mandatory_cookies',  __NAMESPACE__ .'\cookie_name' );
	remove_filter( 'rocket_cache_dynamic_cookies', __NAMESPACE__ . '\cookie_name' );

	// Flush .htaccess rules, and regenerate WP Rocket config file.
	flush_wp_rocket();
}
register_deactivation_hook( __FILE__, __NAMESPACE__ . '\deactivate' );

