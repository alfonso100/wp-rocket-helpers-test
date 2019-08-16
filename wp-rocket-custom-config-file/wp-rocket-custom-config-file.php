<?php
/**
 * Plugin Name: WP Rocket | Custom Config File
 * Description: Checks if site_url() and home_url() are different, and clone the configuration file if needed.
 * Author:      WP Rocket Support Team
 * Author URI:  http://wp-rocket.me/
 * License:     GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Copyright SAS WP MEDIA 2019
 */


namespace WP_Rocket\Helpers\custom_config_file;

// Standard plugin security, keep this line in place.
defined( 'ABSPATH' ) or die();


/**
 * Checks if site_url() and home_url() are different, if they are adds the site_url() to the $config_files_path array.
 *
 * @author {Author Name}
 */
function clone_config( $config_files_path ) {

	$site_url = site_url();
	$home_url = home_url();				
		
	if($site_url !== $home_url) {

		$home_url =  preg_replace('#^https?://#', '', untrailingslashit( $home_url )).'.php' ;
		$site_url =  preg_replace('#^https?://#', '', untrailingslashit( $site_url )).'.php' ;

		$initial_config_file 	= WP_ROCKET_CONFIG_PATH . $home_url;
		$mirror_config_file 	= WP_ROCKET_CONFIG_PATH . $site_url;	
		
		$config_files_path[] = $mirror_config_file;
		
	}
	
	return $config_files_path;

}
	
add_filter( 'rocket_config_files_path', __NAMESPACE__ . '\clone_config' );


/**
 * Regenerates WP Rocket config file.
 *
 */
 
function flush_wp_rocket() {
	if ( ! function_exists( 'flush_rocket_htaccess' )
	  || ! function_exists( 'rocket_generate_config_file' )
	  || ! function_exists( 'rocket_delete_config_file' ) ) {
		return false;
	}
	
	// Update WP Rocket .htaccess rules.
	flush_rocket_htaccess();

	// Regenerate WP Rocket config file.
	rocket_generate_config_file();
	
}

register_activation_hook( __FILE__, __NAMESPACE__ . '\flush_wp_rocket' );


function deactivate() {
	
	// Delete Wp Rocket config files
	if (  function_exists( 'rocket_delete_config_file' ) {
		rocket_delete_config_file();
	}
	
	// Remove customizations upon deactivation.
	remove_filter( 'rocket_config_files_path', __NAMESPACE__ . '\clone_config' );
	
	// Flush .htaccess rules, and regenerate WP Rocket config file.
	flush_wp_rocket();


}
register_deactivation_hook( __FILE__, __NAMESPACE__ . '\deactivate' );

