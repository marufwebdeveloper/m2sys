<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    M2sys
 * @subpackage M2sys/frontend
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    M2sys
 * @subpackage M2sys/frontend
 * @author     Your Name <email@example.com>
 */
class Moksy_Public {

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
	 * @param      string    $m2sys       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $m2sys, $version ) {

		$this->M2sys = $m2sys;
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

		wp_enqueue_style($this->M2sys.'-bootstrap', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css');
		wp_enqueue_style( $this->M2sys, plugin_dir_url( __FILE__ ) . 'css/m2sys-frontend.css');

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
		wp_enqueue_script('jquery');  
		wp_enqueue_script( $this->M2sys.'-m2sys-bootstrap', plugin_dir_url( __FILE__ ) . 'js/bootstrap.bundle.min.js');

		wp_enqueue_script( $this->M2sys, plugin_dir_url( __FILE__ ) . 'js/m2sys-frontend.js');

	}


	public function question_two($atts){
		ob_start();
		if(file_exists($page = plugin_dir_path(__DIR__).'frontend/inc/question-two/question_two.php'));
		require_once $page;
	   $page = ob_get_contents();
	   ob_end_clean();
	   return $page;
	}



	public function ajax(){
		if(file_exists($page = plugin_dir_path(__DIR__).'frontend/inc/ajax.php'));
		require_once $page;
		die();
	}

	public function wp_head(){
		echo "<script>
		m2sys_site_url = '".get_site_url()."';
		m2sys_plugin_url = '".plugin_dir_url(__DIR__)."';
		</script>";

	}

	

}
