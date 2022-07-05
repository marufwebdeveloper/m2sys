<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Moksy
 * @subpackage Moksy/backend
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Moksy
 * @subpackage Moksy/backend
 * @author     Your Name <email@example.com>
 */
class Moksy_Admin {

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
	 * @param      string    $moksy       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $moksy, $version ) {

		$this->Moksy = $moksy;
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

		wp_enqueue_style( $this->Moksy, plugin_dir_url( __FILE__ ) . 'css/moksy-backend.css', array(), $this->version, 'all' );

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

		wp_enqueue_style( 'adminlte', get_template_directory_uri().'/assets/styles/adminlte.min.css');
		wp_enqueue_style( 'adminltep', get_template_directory_uri().'/assets/styles/adminltep.min.css');

		wp_enqueue_script( $this->Moksy, plugin_dir_url( __FILE__ ) . 'js/moksy-backend.js' );


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
		add_menu_page('Moksy Page Builder','Moksy Page Builder','edit_posts','menu_slug',[$this,'moksy_page_builder'],'' );

	}

	/**
	 * Moksy page-builder page content
	 *
	 * @since    1.0.0
	 */
	public function moksy_page_builder() {
		if(file_exists($page = plugin_dir_path( __FILE__ ).'inc/page-builder.php'))
		require_once $page;
	}

	/**
	 * All ajax request comes to this page
	 *
	 * @since    1.0.0
	 */
	public function ajax(){
		if(file_exists($page = plugin_dir_path(__DIR__).'backend/inc/ajax.php'));
		require_once $page;
		die();
	}

	/**
	 * Push CSS or JS within head tag in dashboard
	 *
	 * @since    1.0.0
	 */
	public function admin_head(){
		echo "<script>
			moksy_admin_url = '".admin_url()."'
		</script>";
	}







}
