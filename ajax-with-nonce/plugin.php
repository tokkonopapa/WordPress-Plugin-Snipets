<?php
/*
Plugin Name: My Ajax Sample
Plugin URI: https://github.com/tokkonopapa/WordPress-Plugin-Snipets
Description: A ajax sample using nonce for WordPress.
Version: 0.1
Author: tokkonopapa
Author URI: https://github.com/tokkonopapa
Author Email: 
License: GPLv2 or later
*/

if( ! class_exists( 'MyAjaxSample' ) ) :

class MyAjaxSample {
	// Constants
	const PLUGIN_SLUG = 'my_ajax';

	// Constructor
	function __construct() {
		// Register scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_scripts' ) );

		// Register shortcode
		add_shortcode( self::PLUGIN_SLUG, array( $this, 'enqueue_shortcode' ) );

		// Register ajax callback for logged in and not logged in user
		$action = $this->get_anction_name();
		add_action( 'wp_ajax_' . $action, array( $this, 'ajax_submit' ) );
		add_action( 'wp_ajax_nopriv_' . $action, array( $this, 'ajax_submit' ) );
	}

	// Registers and enqueues JavaScript
	private function register_scripts() {
		$handle = self::PLUGIN_SLUG . '-script';
		wp_enqueue_script( $handle, plugin_dir_url( __FILE__ ) . 'js/script.js', array( 'jquery' ) );

		$action = $this->get_anction_name();
		wp_localize_script( $handle, 'MyAjaxSample', array(
			'action' => $action,
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'ajax_nonce' => wp_create_nonce( $action ),
		) );
	}

	// Registers and enqueues plugin-specific scripts
	public function register_plugin_scripts() {
		$this->register_scripts();
	}

	// Shortcode for '[my_ajax]'
	public function enqueue_shortcode( $atts ) {
		extract( shortcode_atts( array(
			'text' => 'click me',
		), $atts ) );

		$text = sanitize_text_field( $text );
		$code = '<input type="button" id="my_ajax_sample" value="' . $text . '" />';
		$code .= '<p id="my_ajax_response"></p>';
		return $code;
	}

	// Get the name of ajax action
	private function get_anction_name() {
		return self::PLUGIN_SLUG . '-action';
	}

	// Callback for ajax
	public function ajax_submit() {
		$charset = get_option( 'blog_charset' );
//		if ( check_admin_referer( $this->get_anction_name(), 'ajax_nonce', false ) ) {
		if ( wp_verify_nonce( $_REQUEST['ajax_nonce'], $this->get_anction_name() ) ) {
//			if ( is_user_logged_in() )
			if ( current_user_can( 'edit_posts' ) )
				$msg = 'hello, registered user!';
			else
				$msg = 'hello, visitor!';

			header( 'Content-Type: application/json; charset=' . $charset );
			echo json_encode( array( 'message' => $msg ) );
		} else {
			status_header( '403' );
			header( 'Content-Type: text/plain; charset=' . $charset );
			echo 'You don\'t have right permission.';
		}
		die();
	}

} // end class

global $my_ajax_sample;
$my_ajax_sample = new MyAjaxSample();

endif; // class_exists
