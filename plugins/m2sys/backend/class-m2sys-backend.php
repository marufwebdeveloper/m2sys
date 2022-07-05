<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    M2sys
 * @subpackage M2sys/backend
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    M2sys
 * @subpackage M2sys/backend
 * @author     Your Name <email@example.com>
 */
class Moksy_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $m2sys    The ID of this plugin.
	 */
	private $m2sys;

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
	 * @param      string    $m2sys       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $m2sys, $version ) {

		$this->M2sys = $m2sys;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style($this->M2sys.'-bootstrap', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css');
		wp_enqueue_style($this->M2sys.'-jquery-data-table', plugin_dir_url( __FILE__ ) . 'css/jquery.dataTables.css');
		wp_enqueue_style( $this->M2sys, plugin_dir_url( __FILE__ ) . 'css/m2sys-backend.css');


	}

	/**
	 * Register the JavaScript for the admin area.
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
		wp_enqueue_script( $this->M2sys.'-bootstrap', plugin_dir_url( __FILE__ ) . 'js/bootstrap.bundle.min.js');
		wp_enqueue_script( $this->M2sys.'-jquery-data-table', plugin_dir_url( __FILE__ ) . 'js/jquery.dataTables.js');
		
		wp_enqueue_script( $this->M2sys, plugin_dir_url( __FILE__ ) . 'js/m2sys-backend.js');

	}


	/**
	 * Register the menu for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function admin_menus() {

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
		add_menu_page('Qquestion two','Question two data','edit_posts','menu_slug',[$this,'question_two_data'],'' );

	}


	/**
	 * 
	 *
	 * @since    1.0.0
	 */
	public function question_two_data() {
		if(file_exists($page = plugin_dir_path( __FILE__ ).'/inc/question-two/question_two_data_view.php'))
		require_once $page;
	}

	


}
