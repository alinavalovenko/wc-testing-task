<?php
add_action( 'woocommerce_single_product_summary', 'va_display_number_of_views', 5 );
add_action( 'woocommerce_after_shop_loop_item_title', 'va_display_number_of_views', 5 );

function va_display_number_of_views() {
	$views = get_post_meta( get_the_ID(), 'product_number_of_views', true );
	_e( 'This product was viewed ' . ( empty( $views ) ? 0 : $views ) . ' times', 'storefrontchild' );
}

add_action( 'wp_head', 'va_increase_number_of_views' );
function va_increase_number_of_views() {
	if ( is_singular( 'product' ) && ! is_admin() ) {
		$prev_value = (int) get_post_meta( get_the_ID(), 'product_number_of_views', true );
		update_post_meta( get_the_ID(), 'product_number_of_views', ++ $prev_value );
	}
}