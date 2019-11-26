<?php
/***
 * Display number of views
 */
add_action( 'woocommerce_single_product_summary', 'va_display_number_of_views', 5 );
add_action( 'woocommerce_after_shop_loop_item_title', 'va_display_number_of_views', 5 );
function va_display_number_of_views() {
	$views = get_post_meta( get_the_ID(), 'product_number_of_views', true );
	_e( 'This product was viewed ' . ( empty( $views ) ? 0 : $views ) . ' times', 'storefrontchild' );
}

/**
 * Display last purchase date
 */
add_action('woocommerce_product_meta_start', 'va_display_last_purchase_date',20 );
function va_display_last_purchase_date(){
	if ( is_singular( 'product' ) && ! is_admin() ) {
		$last_date = get_post_meta( get_the_ID(), 'product_last_purchase_date', true );
		if(! empty($last_date)) {
			_e( 'Last time this product was bought ' . $last_date, 'storefrontchild' );
		}
	}
}

/***
 * Increase number of views, if product was loaded
 */
add_action( 'wp_head', 'va_increase_number_of_views' );
function va_increase_number_of_views() {
	if ( is_singular( 'product' ) && ! is_admin() ) {
		$prev_value = (int) get_post_meta( get_the_ID(), 'product_number_of_views', true );
		update_post_meta( get_the_ID(), 'product_number_of_views', ++ $prev_value );
	}
}

/***
 * Update date of last purchase
 */
add_action('woocommerce_thankyou', 'va_update_last_purchase_date', 10);
function va_update_last_purchase_date($order_id){
	$order = wc_get_order($order_id);
	$products = $order->get_items();
	foreach ( $products as $id => $product ) {
		update_post_meta($product->get_product_id(), 'product_last_purchase_date', $order->get_date_created()->date('d.m.y') );
	}

}

/***
 * Remove billing postcode from checkout page to make easy demo testing
 */
add_filter( 'woocommerce_checkout_fields' , 'remove_billing_postcode_checkout' );
function remove_billing_postcode_checkout( $fields ) {
	unset($fields['billing']['billing_postcode']);
	return $fields;
}