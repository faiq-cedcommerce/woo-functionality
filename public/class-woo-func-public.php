<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.cedcommerce.com
 * @since      1.0.0
 *
 * @package    Woo_Func
 * @subpackage Woo_Func/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Woo_Func
 * @subpackage Woo_Func/public
 * @author     Faiq Masood <faiqmasood@cedcommerce.com>
 */
class Woo_Func_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
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
		 * defined in Woo_Func_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woo_Func_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woo-func-public.css', array(), $this->version, 'all' );

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
		 * defined in Woo_Func_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woo_Func_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/woo-func-public.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( $this->plugin_name, 'ajaxurl' , array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	}
	function wp_init_session() {
		if ( ! session_id() ) {
			session_start();
		}
	}
	public function add_to_cart_ajax() {
	
		if (isset($_POST['prod_id'], $_POST['quantity']) && is_numeric($_POST['prod_id']) && is_numeric($_POST['quantity'])) {
			
			$product_id 	= (int)$_POST['prod_id'];
    		$quantity 		= (int)$_POST['quantity'];
			
			global $wpdb;
			$table_name = $wpdb->prefix . 'posts';
			$count_query = "select count(*) from $table_name where ID = $product_id AND post_status = 'publish' ";
			$product = $wpdb->get_var($count_query);
			if ($product && $quantity > 0) {

				if (isset($_SESSION['mycart']) && is_array($_SESSION['mycart'])) {
					if (array_key_exists($product_id, $_SESSION['mycart'])) {
						
						$_SESSION['mycart'][$product_id] += $quantity;
					} else {
						
						$_SESSION['mycart'][$product_id] = $quantity;
					}
				} else {
					
					$_SESSION['mycart'] = array($product_id => $quantity);
				}
			}
		}
		print_r( $_SESSION['mycart'] );
		die;
	}

	public function remove_from_cart_ajax() {
	
		if (isset($_POST['remove']) && is_numeric($_POST['remove']) && isset($_SESSION['mycart']) && isset($_SESSION['mycart'][$_POST['remove']])) {
			// Remove the product from the shopping cart
			unset($_SESSION['mycart'][$_POST['remove']]);
		}
		
		die;

	}
}
