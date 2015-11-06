<?php
/*
Plugin Name: 	R3DF - Beaver Builder TinyMCE Advanced Icon Fix
Description:    Fixes font icon's not showing in TinyMCE with TinyMCE Advanced and Beaver Builder.
Plugin URI:		http://r3df.com/
Version: 		1.0.0
Text Domain:	r3df-beaver-builder-tinymce-advanced-icon-fix
Domain Path: 	/lang/
Author:         R3DF
Author URI:     http://r3df.com
Author email:   plugin-support@r3df.com
Copyright: 		R-Cubed Design Forge
*/


/*  Copyright 2015 R-Cubed Design Forge

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Avoid direct calls to this file where wp core files not present
if ( ! function_exists( 'add_action' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

$r3df_bb_mce_adv_icon_fix = new R3DF_BB_MCE_Adv_Icon_Fix();


/**
 * Class R3DF_BB_MCE_Adv_Fix
 *
 */
class R3DF_BB_MCE_Adv_Icon_Fix {

	/**
	 * Class constructor
	 *
	 */
	function __construct() {

		if ( is_admin() ) {

		} else {

			// load css and javascript
			add_action( 'wp_enqueue_scripts', array( $this, '_load_scripts_and_styles' ), 1000 );
		}
	}

	/* ****************************************************
	 * Utility functions
     * ****************************************************/

	/**
	 * Site scripts and styles loader
	 *
	 * @param $hook
	 *
	 */
	function _load_scripts_and_styles( $hook ) {
		// Get the plugin version (added to files loaded to clear browser caches on change)
		$plugin = get_file_data( __FILE__, array( 'Version' => 'Version' ) );

		// check if BB styles loaded && tinyMCE Advanced is enabled
		if ( wp_style_is( 'fl-builder', 'enqueued' ) || wp_style_is( 'fl-builder-rtl', 'enqueued' )  ) {
			if ( class_exists('Tinymce_Advanced') ) {
				// Register and enqueue the css files
				wp_register_style( 'r3df-bb-mce-style', plugins_url( '/css/style.css', __FILE__ ), false, $plugin['Version'] );
				wp_enqueue_style( 'r3df-bb-mce-style' );
			}
		}
	}
}
