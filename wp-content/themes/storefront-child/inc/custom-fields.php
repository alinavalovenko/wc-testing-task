<?php
add_action( 'add_meta_boxes', 'va_add_custom_box' );
function va_add_custom_box() {
	$screens = array( 'product' );
	add_meta_box( 'va_additional_info', __( 'Additional Info', 'storefrontchild' ), 'va_meta_box_callback', $screens, 'side', 'high' );
}

/***
 * Display field with number of views in add/edit product page
 *
 * @param $post
 * @param $meta
 */
function va_meta_box_callback( $post, $meta ) {
	$views = get_post_meta( $post->ID, 'product_number_of_views', true );
	echo '<label for="va_number_of_views">' . __( "Number of views of current product", 'storefrontchild' ) . '</label> ';
	echo '<input type="text" id="va_number_of_views" name="va_number_of_views" value="' . ( empty( $views ) ? 0 : $views ) . '" size="25"  readonly/><br/>';

	$last_purchase = get_post_meta($post->ID, 'product_last_purchase_date', true);
	echo '<br/><label for="last_purchase_date">' . __( "Date of the last purchase", 'storefrontchild' ) . '</label> ';
	echo '<input type="text" id="va_last_purchase_date" name="va_last_purchase_date" value="' . ( empty( $last_purchase ) ? 'There are no orders' : $last_purchase ) . '" size="25"  readonly/>';
}
