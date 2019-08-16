<?php 
/**
 * Plugin Name: WP Rocket | Exclude JS from minification and combine at some URLs
 * Plugin URI: https://github.com/wp-media/wp-rocket-helpers/
 * Description: 
 * Version: 1.0
 * Author: WP Rocket Support Team
 * Author URI: https://wp-rocket.me
 * License:	GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Copyright 2019 WP Media <support@wp-rocket.me>
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit; 

function exclude( $excluded_files ) {
	
	//Edit this value to match your current path
	if(strpos($_SERVER['REQUEST_URI'], 'quiz') !== false):
						    
		//Edit the files you'd like to exclude. You can add more lines				    
		$excluded_files[] = '/wp-includes/js/jquery/jquery.js';
							
	 else: 
								 
		$excluded_files[] = '';
								 
	 endif;
	 
	return $excluded_files;
}

add_filter( 'rocket_exclude_js', 'exclude' );

