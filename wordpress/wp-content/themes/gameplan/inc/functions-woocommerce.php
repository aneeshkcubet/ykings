<?php
define ('WOOCOMMERCE_FUNC',1);

add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}

// Redefine woocommerce_output_related_products()
function woocommerce_output_related_products() {
	woocommerce_related_products(3,3); // Display 4 products in rows of 2
}

/* Get ID of current woocommerce page */
function get_current_woocommerce_page_ID(){
	if(is_woocommerce()) return woocommerce_get_page_id('shop');
	if(is_cart()) return woocommerce_get_page_id('cart');
	if(is_checkout()) return woocommerce_get_page_id('checkout');
	if(is_woocommerce_myaccount_page()) return woocommerce_get_page_id('myaccount');
	if(is_woocommerce_thanks_page()) return woocommerce_get_page_id('thanks');
	if(is_woocommerce_editaddress_page()) return woocommerce_get_page_id('edit_address');
	if(is_woocommerce_changepassword_page()) return woocommerce_get_page_id('change_password');
	if(is_woocommerce_vieworder_page()) return woocommerce_get_page_id('view_order');
	if(is_woocommerce_lostpassword_page) return woocommerce_get_page_id('lost_password');
	if(is_woocommerce_logout_page) return woocommerce_get_page_id('logout');
	
	return 0;
}

/* Used to check if current page is one of woocommerce page */
function is_woocommerce_page(){
	return class_exists('Woocommerce') && (is_woocommerce() || is_cart() || is_checkout() || is_woocommerce_myaccount_page() || is_woocommerce_thanks_page() || is_woocommerce_editaddress_page() || is_woocommerce_changepassword_page() || is_woocommerce_vieworder_page() || is_woocommerce_lostpassword_page() || is_woocommerce_logout_page());
}

/* Used to check if current page is My Account page */
function is_woocommerce_myaccount_page(){	
	return class_exists('Woocommerce') && is_page(woocommerce_get_page_id( 'myaccount' ));
}

/* Used to check if current page is Edit Address page */
function is_woocommerce_editaddress_page(){
	return class_exists('Woocommerce') && is_page(woocommerce_get_page_id( 'edit_address' ));
}

/* Used to check if current page is Thanks page */
function is_woocommerce_thanks_page(){
	return class_exists('Woocommerce') && is_page(woocommerce_get_page_id( 'thanks' ));
}

/* Used to check if current page is Change Password page */
function is_woocommerce_changepassword_page(){
	return class_exists('Woocommerce') && is_page(woocommerce_get_page_id( 'change_password' ));
}

function is_woocommerce_vieworder_page(){
	return class_exists('Woocommerce') && is_page(woocommerce_get_page_id( 'view_order' ));
}

function is_woocommerce_lostpassword_page(){
	return class_exists('Woocommerce') && is_page(woocommerce_get_page_id( 'lost_password' ));
}

function is_woocommerce_logout_page(){
	return class_exists('Woocommerce') && is_page(woocommerce_get_page_id( 'logout' ));;
}
