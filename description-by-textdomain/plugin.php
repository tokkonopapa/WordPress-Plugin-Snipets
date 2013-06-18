<?php
/*
Plugin Name: Description by Text Domain
Plugin URI: https://github.com/tokkonopapa/WordPress-Plugin-Snipets
Description: A sample description for multi languages on the dashboard.
Version: 0.1.0
Author: tokkonopapa
Author URI: https://github.com/tokkonopapa
Author Email: 
License: GPLv2 or later
Text Domain: description-by-textdomain
Domain Path: /languages/
*/

if( ! class_exists( 'MyDescSample' ) ) :

class MyDescSample {
	/**
	 * Constants
	 */
	const TEXTDOMAIN = 'description-by-textdomain';

	/**
	 * Constructor
	 */
	function __construct() {
		// Load plugin text domain
		add_action( 'plugins_loaded', array( $this, 'plugin_textdomain' ) ); // @since 1.2.0
	}

	/**
	 * Load the plugin text domain for translation.
	 * @link http://codex.wordpress.org/Function_Reference/load_plugin_textdomain
	 */
	public function plugin_textdomain() {
		load_plugin_textdomain( self::TEXTDOMAIN, false, dirname( __FILE__ ) . '/languages/' ); // @since 1.5.0
	}

} // end class

new MyDescSample();

endif; // class_exists
