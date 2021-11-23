<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.cedcommerce.com
 * @since      1.0.0
 *
 * @package    Woo_Func
 * @subpackage Woo_Func/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Woo_Func
 * @subpackage Woo_Func/includes
 * @author     Faiq Masood <faiqmasood@cedcommerce.com>
 */
class Woo_Func_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;
        $mycart_page 		    = get_page_by_title( 'My Cart' );
        $myshop_page		    = get_page_by_title( 'My Shop' );
        $mycheckout_page		= get_page_by_title( 'My Checkout' );

		if ( ! $mycart_page ) {
            $_mycart 					= array();
            $_mycart['post_title'] 		= 'My Cart';
            $_mycart['post_content'] 	= "[sc_show_mycart]";
            $_mycart['post_status'] 	= 'publish';
            $_mycart['post_type'] 		= 'page';
            $_mycart['comment_status'] 	= 'closed';
            $mycart_id 					= wp_insert_post( $_mycart );
        }
        else {
            $mycart_id 				= wp_update_post( $mycart_page );
        }

		if(	! $myshop_page	){
			$_myshop 					= array();
            $_myshop['post_title'] 		= 'My Shop';
            $_myshop['post_content'] 	= "[sc_show_myshop]";
            $_myshop['post_status'] 	= 'publish';
            $_myshop['post_type'] 		= 'page';
            $_myshop['comment_status'] 	= 'closed';
            $myshop_id 					= wp_insert_post( $_myshop );	
		}else{
            $myshop_id = wp_update_post( $myshop_page );
		}

        if(	! $mycheckout_page	){
			$_mycheckout 					= array();
            $_mycheckout['post_title'] 		= 'My Checkout';
            $_mycheckout['post_content'] 	= "[sc_show_mycheckout]";
            $_mycheckout['post_status'] 	= 'publish';
            $_mycheckout['post_type'] 		= 'page';
            $_mycheckout['comment_status'] 	= 'closed';
            $mycheckout_id 					= wp_insert_post( $_mycheckout );	
		}else{
            $mycheckout_id = wp_update_post( $checkout_page );
		}

    }

}
