<?php
/**
 * Setup theme features.
 */
function lifefood_theme_support() {
	load_theme_textdomain( 'spotted', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'woocommerce' );

	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'lifefood' ),
	) );

	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'caption',
	) );
}
add_action( 'after_setup_theme', 'lifefood_theme_support' );


/**
 * Enqueue scripts and styles.
 */
function initialize_scripts() {
	wp_enqueue_style( 'main_style', get_template_directory_uri() . '/style.css',false,null,'all');
	wp_enqueue_style( 'shortcodes', get_template_directory_uri() . '/library/css/shortcodes.css',false,null,'all');
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/library/css/animate.min.css',false,null,'all');

	wp_enqueue_script('custom', get_template_directory_uri() . '/library/js/custom.js', array('jquery'), null, true );
//	wp_enqueue_script('jquery.fullPage', get_template_directory_uri() . '/library/js/jquery.fullPage.min.js', array('jquery'), null, true );
	wp_localize_script( 'custom', 'custom_vars',
		array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce('custom-nonce')
		)
	);
}
add_action( 'wp_enqueue_scripts', 'initialize_scripts' );


//// Render fields at the bottom of variations - does not account for field group order or placement.
//add_action( 'woocommerce_product_after_variable_attributes', function( $loop, $variation_data, $variation ) {
//	global $abcdefgh_i; // Custom global variable to monitor index
//	$abcdefgh_i = $loop;
//	// Add filter to update field name
//	add_filter( 'acf/prepare_field', 'acf_prepare_field_update_field_name' );
//
//	// Loop through all field groups
//	$acf_field_groups = acf_get_field_groups();
//	foreach( $acf_field_groups as $acf_field_group ) {
//		foreach( $acf_field_group['location'] as $group_locations ) {
//			foreach( $group_locations as $rule ) {
//				// See if field Group has at least one post_type = Variations rule - does not validate other rules
//				if( $rule['param'] == 'post_type' && $rule['operator'] == '==' && $rule['value'] == 'product_variation' ) {
//					// Render field Group
//					acf_render_fields( $variation->ID, acf_get_fields( $acf_field_group ) );
//					break 2;
//				}
//			}
//		}
//	}
//
//	// Remove filter
//	remove_filter( 'acf/prepare_field', 'acf_prepare_field_update_field_name' );
//}, 10, 3 );
//
//// Filter function to update field names
//function  acf_prepare_field_update_field_name( $field ) {
//	global $abcdefgh_i;
//	$field['name'] = preg_replace( '/^acf\[/', "acf[$abcdefgh_i][", $field['name'] );
//	return $field;
//}
//
//// Save variation data
//add_action( 'woocommerce_save_product_variation', function( $variation_id, $i = -1 ) {
//	// Update all fields for the current variation
//	if ( ! empty( $_POST['acf'] ) && is_array( $_POST['acf'] ) && array_key_exists( $i, $_POST['acf'] ) && is_array( ( $fields = $_POST['acf'][ $i ] ) ) ) {
//		foreach ( $fields as $key => $val ) {
//			update_field( $key, $val, $variation_id );
//		}
//	}
//}, 10, 2 );
//
////add ACF rule
//add_filter('acf/location/rule_values/post_type', 'acf_location_rule_values_Post');
//function acf_location_rule_values_Post( $choices ) {
//	$choices['product_variation'] = 'Product Variation';
//	//print_r($choices);
//	return $choices;
//}

add_action( 'woocommerce_before_cart_table', 'action_function_name_8469' );
function action_function_name_8469(){
	if (get_locale() == 'ua') {
		$cart = "Оформлення замовлення";
	} else {
		$cart = "Oформление заказа";
	}
	echo '<h2 class="cart_title">'.$cart.'</h2>';
}
?>