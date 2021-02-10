<?php
 /*
Plugin Name: WooCommerce to Learn Dash Groups
Plugin URI:
Description: Add user to LearnDash Group if purchases specific WooCommerce product.
Version: 1.1.0
Author: TecGuru
Author URI: https://tecguru.co
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
//Triggered when a payment is made on a subscription. This can be payment for the initial order.
add_action( 'woocommerce_order_status_completed', 'woolms_add_user_to_group', 10, 1 );
/*
@woolms_add_user_to_group
*/
function woolms_add_user_to_group( $order_id ) {
  // Add group ID from LearnDash here
  $ld_group_id = 116113;
  // Add product ID from WooCommerce here
  $wc_product_id = 116115;
  $order = new WC_Order( $order_id );
  $items = $order->get_items();
  foreach ( $items as $item ) {
    if ( $wc_product_id == $item['product_id'] ) {
      ld_update_group_access( $order->customer_id, $ld_group_id, false );
    }
  }
}

/*
*@woocommerce_subscription_status_active
*/
add_action('woocommerce_subscription_status_active', 'woolms_add_user_to_groupa', 10, 1 );

  function woolms_add_user_to_groupa($subscription){

      $sub = $subscription->get_data();
	  $order_id = $sub['parent_id'];
	 // Add group ID from LearnDash here
	 $ld_group_id = 116113;
	 // Add product ID from WooCommerce here
	 $wc_product_id = 116115;
	$order = new WC_Order( $order_id );
	$items = $order->get_items();
	foreach ( $items as $item ) {
		if ( $wc_product_id == $item['product_id'] ) {
		ld_update_group_access( $order->customer_id, $ld_group_id, false );
	  }
	}
  }
 /*
*@woocommerce_subscription_status_on-hold
*@woocommerce_subscription_status_cancelled
*@woocommerce_subscription_status_expired
*/

add_action('woocommerce_subscription_status_on-hold', 'woolms_remove_user_to_group', 10, 1 );
add_action('woocommerce_subscription_status_cancelled', 'woolms_remove_user_to_group', 10, 1 );
add_action('woocommerce_subscription_status_expired', 'woolms_remove_user_to_group', 10, 1 );
  function woolms_remove_user_to_group($subscription){

      $sub = $subscription->get_data();
	  $order_id = $sub['parent_id'];
	 // Add group ID from LearnDash here
	 $ld_group_id = 116113;
	 // Add product ID from WooCommerce here
	 $wc_product_id = 116115;
	$order = new WC_Order( $order_id );
	$items = $order->get_items();
	foreach ( $items as $item ) {
		if ( $wc_product_id == $item['product_id'] ) {
		ld_update_group_access( $order->customer_id, $ld_group_id, true );
	  }
	}
  }
?>
