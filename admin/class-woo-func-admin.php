<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.cedcommerce.com
 * @since      1.0.0
 *
 * @package    Woo_Func
 * @subpackage Woo_Func/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Woo_Func
 * @subpackage Woo_Func/admin
 * @author     Faiq Masood <faiqmasood@cedcommerce.com>
 */
class Woo_Func_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
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
		 * defined in Woo_Func_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woo_Func_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woo-func-admin.css', array(), $this->version, 'all' );

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
		 * defined in Woo_Func_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woo_Func_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/woo-func-admin.js', array( 'jquery' ), $this->version, false );

	}
	
	//Register Product CPT 
	function register_product_CPT() {
 
		$labels = array(
			'name'               => 'Products Testing',
			'singular_name'      => 'Product',
			'add_new'            => 'Add New',
			'add_new_item'       => 'Add New Product',
			'edit_item'          => 'Edit Product',
			'new_item'           => 'New Product',
			'all_items'          => 'All Product',
			'view_item'          => 'View Product',
			'search_items'       => 'Search Product',
			'not_found'          => 'No Products found',
			'not_found_in_trash' => 'No Products found in Trash',
			'parent_item_colon'  => '',
			'menu_name'          => 'Products Testing'
		);
	 
		$args = array(
			'labels' 				=> $labels,
			'public' 				=> true,
			'publicly_queryable' 	=> true,
			'show_ui' 				=> true,
			'query_var' 			=> true,
			'rewrite' 			 	=> array('slug' => 'myproduct/%product-category%'),
			'capability_type' 		=> 'post',
			'hierarchical' 			=> false,
			'menu_position' 		=> 8,
			'supports' 				=> array('title','editor','thumbnail')
		);
	 
		register_post_type( 'myproduct', $args );
	 
	}

		//Register ORDER CPT 
		function register_order_CPT() {
 
			$labels = array(
				'name'               => 'My Shopping Orders',
				'singular_name'      => 'Shopping Order',
				'add_new'            => 'Add New',
				'add_new_item'       => 'Add New Shopping Order',
				'edit_item'          => 'Edit Shopping Order',
				'new_item'           => 'New Shopping Order',
				'all_items'          => 'All Shopping Order',
				'view_item'          => 'View Shopping Order',
				'search_items'       => 'Search Shopping Order',
				'not_found'          => 'No Shopping Orders found',
				'not_found_in_trash' => 'No Shopping Orders found in Trash',
				'parent_item_colon'  => '',
				'menu_name'          => 'My Shopping Orders'
			);
		 
			$args = array(
				'labels' 				=> $labels,
				'public' 				=> false,
				'publicly_queryable' 	=> false,
				'show_ui' 				=> true,
				'query_var' 			=> true,
				'capability_type' 		=> 'post',
				'hierarchical' 			=> false,
				'menu_position' 		=> 8,
				'supports' 				=> array('title','editor','thumbnail')
			);
		 
			register_post_type( 'myorder', $args );
		 
		}

	//Product Category
	function product_taxonomy() {
		$labels = array(
			'name'              => 'Products Category',
			'singular_name'     => 'Product Category',
			'search_items'      => 'Search Products',
			'all_items'         => 'All Products',
			'parent_item'       => 'Parent Category',
			'parent_item_colon' => 'Parent Category',
			'edit_item'         => 'Edit Category',
			'update_item'       => 'Update Category',
			'add_new_item'      => 'Add New Category',
			'new_item_name'     => 'New Category Name',
			'menu_name'         => 'Categories',
		);
		$args = array(
			'hierarchical'      => true, // Set this to 'false' for non-hierarchical taxonomy (like tags)
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'product-category' ),
		);
		register_taxonomy( 'product-category', array( 'myproduct' ), $args );
	}
		
	// Rewrite the CPT
	function products_post_link( $post_link, $id = 0 ){
		$post = get_post($id);  
        $terms = wp_get_object_terms( $post->ID, 'product-category' );
        if( $terms ){
            return str_replace( '%product-category%' , $terms[0]->slug , $post_link );
			} else {
	    	return str_replace( '%product-category%/' , '' , $post_link );
		}
	
    	return $post_link; 
	}
	
	//Add Price metabox
	public function add_price_metabox() {
		add_meta_box( 'price_metabox', 'Product Price', array( $this, 'product_price_show' ), 'myproduct', 'side', 'default' );
	}
	//Add Show Order metabox
	public function show_order_metabox() {
		add_meta_box( 'order_metabox', 'Order Summary', array( $this, 'show_order' ), 'myorder', 'normal', 'default' );
	}
	//Showing the ORDER Meta Box to product field CPT
	public function show_order() {
		global $post;
		$products_in_cart = get_post_meta($post->ID, 'myorder_detail')[0];
		$products = array();
		$args = array(
			'post_type' => 'myproduct',
			'post__in' => array_keys($products_in_cart),
		);
		
		$products = get_posts($args);
		
		$subtotal = 0.00;		
		
		if (count($products_in_cart) > 0) {

			foreach ($products as $product) {
				$subtotal +=  (float)get_post_meta( $product->ID, '_product_price' )[0]*(int)$products_in_cart[$product->ID];	
				
			}

			?>
			<h3> My Order Details</h3>
			<table>
						<thead>
							<tr>
								<th>Product</th>
								<th>Subtotal</th>
							</tr>
						</thead>
						<tbody>
							
							<?php 
							if (count($products_in_cart) > 0 ){

								$sno = 1;
								foreach ($products as $product): ?>
							<tr>
								
								<td>
									<?php echo $product->post_title;?> <b>X <?php echo (int)$products_in_cart[$product->ID]; ?></b>
								</td>
								<td class="quantity"><b>Rs. <?php echo (float)get_post_meta( $product->ID, '_product_price' )[0]*(int)$products_in_cart[$product->ID] ; ?></b></td>
							</tr>
							<?php 
							$sno++;
							endforeach;
							?>
							 <tr>
								
								<td>
									<b>Total</b>
								</td>
								<td class="quantity"><b>Rs. <span style="font-size: 22px"><?php echo (float)$subtotal ?></span></b></td>
							</tr>
						<?php	
						}else{
							?>
							<tr>
								<td colspan="7" style="text-align:center;">You have no products added in your Shopping Cart</td>
							</tr>
							<?php
							}
							?>
							
						</tbody>
					</table>
					
		<?php
		}	
			
	}
	//Showing the Price Meta Box to product field CPT
	public function product_price_show() {
		global $post;
		wp_nonce_field( 'price_nonce', 'price_nonce' );
		$price = get_post_meta( $post->ID, '_product_price', true );
		echo '<input type="number" name="price" value="' . esc_textarea( $price )  . '" class="widefat">';
	}

	//Saving the data of Price Meta Box
	public function save_price_meta_value( $post_id, $post ) {

		  // Check if our nonce is set.
		  if ( ! isset( $_POST['price_nonce'] ) ) {
			return;
		  }
	
		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $_POST['price_nonce'], 'price_nonce' ) ) {
			return;
		}
	
		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
	
		// Check the user's permissions.
		if ( isset( $_POST['post_type'] ) && 'myproduct' == $_POST['post_type'] ) {
	
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
	
		}
		else {
	
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		}
	
		if ( ! isset( $_POST['price'] ) ) {
			return;
		}
	
		// Sanitize user input.
		$my_data = sanitize_text_field( $_POST['price'] );
	
		// Update the meta field in the database.
		update_post_meta( $post_id, '_product_price', $my_data );
	
	}

	public function register_shortcodes() {
		add_shortcode( 'sc_show_mycart', array( $this, 'show_mycart') );
		add_shortcode( 'sc_show_myshop', array( $this, 'show_myshop') );
		add_shortcode( 'sc_show_mycheckout', array( $this, 'show_mycheckout') );
	}

	//Shortcode Callback for the Show MyCheckout
	function show_mycheckout( ) {
		$products_in_cart = isset($_SESSION['mycart']) ? $_SESSION['mycart'] : array();
		$products = array();
		$args = array(
			'post_type' => 'myproduct',
			'post__in' => array_keys($products_in_cart),
		);
		
		$products = get_posts($args);		
		$subtotal = 0.00;		

		if (count($products_in_cart) > 0) {

			foreach ($products as $product) {
				$subtotal +=  (float)get_post_meta( $product->ID, '_product_price' )[0]*(int)$products_in_cart[$product->ID];	
				
			}

			?>
			<h3> My Order Details</h3>
			<table>
						<thead>
							<tr>
								<th>Product</th>
								<th>Subtotal</th>
							</tr>
						</thead>
						<tbody>
							
							<?php 
							if (count($products_in_cart) > 0 ){

								$sno = 1;
								foreach ($products as $product): ?>
							<tr>
								
								<td>
									<?php echo $product->post_title;?> <b>X <?php echo (int)$products_in_cart[$product->ID]; ?></b>
								</td>
								<td class="quantity"><b>Rs. <?php echo (float)get_post_meta( $product->ID, '_product_price' )[0]*(int)$products_in_cart[$product->ID] ; ?></b></td>
							</tr>
							<?php 
							$sno++;
							endforeach;
							?>
							 <tr>
								
								<td>
									<b>Total</b>
								</td>
								<td class="quantity"><b>Rs. <span style="font-size: 22px"><?php echo (float)$subtotal ?></span></b></td>
							</tr>
						<?php	
						}else{
							?>
							<tr>
								<td colspan="7" style="text-align:center;">You have no products added in your Shopping Cart</td>
							</tr>
							<?php
							}
							?>
							
						</tbody>
					</table>
					<form method="post">
						<p>Customer Name:</label>
						<input type="text" name="cust_name" id="cust_name" /></p>
						<p>Address: 
						<textarea name="cust_address" id="cust_address" rows="4" cols="20"></textarea> </p>
						<button type="submit">Checkout</button>
						<input type="hidden" name="post_type" id="post_type" value="myorder" />
						<?php wp_nonce_field( 'cpt_nonce_action', 'cpt_nonce_field' ); ?>
					</form>
		<?php	
			if (isset( $_POST['cpt_nonce_field'] ) && wp_verify_nonce( $_POST['cpt_nonce_field'], 'cpt_nonce_action' ) ) {
			
				$my_cptpost_args = array(
					'post_title'    => $_POST['cust_name'],
					'post_content'  => $_POST['cust_address'],
					'post_status'   => 'publish',
					'post_type' 	=> $_POST['post_type'],
				);
				$cpt_id = wp_insert_post( $my_cptpost_args);
				update_post_meta($cpt_id, 'myorder_detail', $_SESSION['mycart']);
				unset($_SESSION['mycart']);
				if($cpt_id > 0){
					?>
					<h3>Successfully Submited</h3>
					<?php
				}
			}

		}else{
			echo "There is no item in the Cart!!!!";
		}
		
	}


	function show_mycart( ) {
		$products_in_cart = isset($_SESSION['mycart']) ? $_SESSION['mycart'] : array();
		$products = array();
		$args = array(
			'post_type' => 'myproduct',
			'post__in' => array_keys($products_in_cart),
		);
		
		$products = get_posts($args);		
		$subtotal = 0.00;		

		if ($products_in_cart) {

			foreach ($products as $product) {
				$subtotal +=  (float)get_post_meta( $product->ID, '_product_price' )[0]*(int)$products_in_cart[$product->ID];	
				
			}
		}
		
		?>
		<div class="cart content-wrapper">
				<h1>Shopping Cart</h1>
				
					<table>
						<thead>
							<tr>
								<th>Sr No</th>
								<th colspan="3">Product</th>
								<th>Quantity</th>
								<th>Price</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							
							<?php 
							if (count($products_in_cart) > 0 ){

								$sno = 1;
								foreach ($products as $product): ?>
							<tr>
								<td><?php echo $sno;?></td>
								<td class="img">
									<a href="index.php?page=product&id=">
										<img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($product->ID) )?>" width="50" height="50" alt="">
									</a>
								</td>
								<td>
								<button name="add_to_cart" prod_id= <?php echo $product->ID; ?> class="ced_remove_from_cart">Remove</button>
								</td>
								<td>
									<?php echo $product->post_title;?>
								</td>
								<td class="quantity"><?php echo (int)$products_in_cart[$product->ID]; ?></td>
								<td class="price"><?php echo (float)get_post_meta( $product->ID, '_product_price' )[0] ?></td>
								<td class="total"><b><?php echo (float)get_post_meta( $product->ID, '_product_price' )[0]*(int)$products_in_cart[$product->ID] ; ?></b></td>
							</tr>
							<?php 
							$sno++;
							endforeach; 
							}else{
							?>
							<tr>
								<td colspan="7" style="text-align:center;">You have no products added in your Shopping Cart</td>
							</tr>
							<?php
							}
							?>
							
						</tbody>
					</table>
					<?php
						if (count($products_in_cart) > 0 ){
					?>
					<div class="subtotal" style="text-align: right;">
						<span class="text">Subtotal</span>
						<span style="font-size:22px; "><b>Rs: <?=$subtotal?></b></span>
					</div>
					
					<div class="buttons">
					<button name="proceed_to_checkout"  class="ced_proceed_to_checkout">Proceed To Checkout</button>
					</div>
					<?php
						}
					?>		
			</div>
			<?php
	}	

	function show_myshop(){
		global $post;
		$args = array(
			'post_type'      => 'myproduct',
			'posts_per_page' => '-1',
			'publish_status' => 'published',
		 );
		 $result = "";
		$query = new WP_Query($args);

		if($query->have_posts()) :

			while($query->have_posts()) :

				$query->the_post() ;					
				$result .= '<div style="border: solid 2px #000;width: 300px;padding: 20px;margin:20px;">';
				$result .= '<div style="width:260px; height:180px;"><a href="'. esc_url(get_permalink($post->ID)) .'">' . get_the_post_thumbnail() . '</a></div>';
				$result .= '<div style="color: #5c370c; font-size: 24px; font-weight: 800" >' . get_the_title() . '</div>';
				$result .= '<div style="color: #000; font-size: 18px; font-weight: 600;"><i>' . get_the_content() . '</i></div>'; 
				$result .= '<div style="color: red; font-size: 24px; font-weight: 800;">Rs: ' . get_post_meta($post->ID, '_product_price')[0] . '</div>'; 
				$result .= '<div style="margin-top:20px;"><button name="add_to_cart" prod_id="' .$post->ID. '" class="button ced_add_to_cart">Add to Cart</button></div>'; 
				$result .= '</div>';
				
			endwhile;
			
			wp_reset_postdata();

		endif;  
		return $result;  
	}
	
	function load_my_single_custom_template( $template ) {
		global $post;
   		$file = dirname(__FILE__) .'/single-'. $post->post_type .'.php';
		if( file_exists( $file ) ) $template = $file;
		return $template;
	}

	
}
