<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Moksy
 * @subpackage Moksy/frontend
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Moksy
 * @subpackage Moksy/frontend
 * @author     Your Name <email@example.com>
 */
class Moksy_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $moksy    The ID of this plugin.
	 */
	private $moksy;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $moksy       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $moksy, $version ) {

		$this->Moksy = $moksy;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Moksy_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Moksy_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->Moksy, plugin_dir_url( __FILE__ ) . 'css/moksy-frontend.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Moksy_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Moksy_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->Moksy, plugin_dir_url( __FILE__ ) . 'js/moksy-frontend.js', array( 'jquery' ), $this->version, false );

	}

}
