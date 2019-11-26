<?php
add_action( 'add_meta_boxes', 'va_add_custom_box' );
function va_add_custom_box() {
	$screens = array( 'product' );
	add_meta_box( 'va_number_of_views', __( 'Number of views', 'storefrontchild' ), 'va_meta_box_callback', $screens, 'side', 'high' );
}

/***
 * Display field with number of views in add/edit product page
 *
 * @param $post
 * @param $meta
 */
function va_meta_box_callback( $post, $meta ) {
	$value = get_post_meta( $post->ID, 'product_number_of_views', 1 );
	echo '<label for="myplugin_new_field">' . __( "Number of views of current product", 'storefrontchild' ) . '</label> ';
	echo '<input type="text" id="va_number_of_views" name="va_number_of_views" value="' . ( empty( $value ) ? 0 : $value ) . '" size="25"  readonly/>';
}
