<?php
/*
Plugin Name: Get Instance
Plugin URI: https://github.com/tokkonopapa/WordPress-Plugin-Snipets
Description: Get instance of this plugin class from static object.
Version: 0.1.0
Author: tokkonopapa
Author URI: https://github.com/tokkonopapa
Author Email: 
License: GPLv2 or later
*/

if( ! class_exists( 'MyGetInstance' ) ) :

class MyGetInstance {
	/**
	 * Instance of this class.
	 */
	protected static $instance = null;

	/**
	 * Constructor
	 */
	function __construct() {
	}

	/**
	 * Return an instance of this class.
	 * @return object: A single instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

} // end class

MyGetInstance::get_instance();

endif; // class_exists
