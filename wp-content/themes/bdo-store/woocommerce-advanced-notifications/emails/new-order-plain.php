<?php
/**
 * New order email (plain)
 */
if ( ! defined( 'ABSPATH' ) ) exit;

printf( __( 'Hi %s,', 'woocommerce-advanced-notifications' ), esc_html( $recipient_name ) );

echo "\n\n";

/* translators: 1: first name 2: last name */
printf( __( 'You have received an order from %s %s:', 'woocommerce-advanced-notifications' ), version_compare( WC_VERSION, '3.0.0', '<' ) ? $order->billing_first_name : $order->get_billing_first_name(), version_compare( WC_VERSION, '3.0.0', '<' ) ? $order->billing_last_name : $order->get_billing_last_name() );

echo "\n\n\n";

printf( __( 'Order: %s', 'woocommerce-advanced-notifications' ), esc_html( $order->get_order_number() ) );

echo "\n";

printf( '%s', date_i18n( __('jS F Y', 'woocommerce-advanced-notifications'), strtotime( version_compare( WC_VERSION, '3.0.0', '<' ) ? $order->order_date : $order->get_date_created() ) ) );

echo "\n\n";



$displayed_total = 0;

foreach ( $order->get_items() as $item_id => $item ) {

	$_product = $order->get_product_from_item( $item );

	$display = false;

	$product_id = $_product->is_type( 'variation' ) && version_compare( WC_VERSION, '3.0', '>=' ) ? $_product->get_parent_id() : $_product->get_id();

	if ( $triggers['all'] || in_array( $product_id, $triggers['product_ids'] ) || in_array( $_product->get_shipping_class_id(), $triggers['shipping_classes'] ) )
		$display = true;

	if ( ! $display ) {

		$cats = wp_get_post_terms( $product_id, 'product_cat', array( "fields" => "ids" ) );

		if ( sizeof( array_intersect( $cats, $triggers['product_cats'] ) ) > 0 ) {
			$display = true;
		}

	}

	if ( ! $display ) {
		continue;
	}

	$displayed_total += $order->get_line_total( $item, true );

	$item_meta = version_compare( WC_VERSION, '3.0', '<' ) ? new WC_Order_Item_Meta( $item ) : new WC_Order_Item_Product( $item_id );

	// Product name
	echo "\n" . apply_filters( 'woocommerce_order_product_title', $item['name'], $_product );

	// SKU
	echo $_product->get_sku() ? ' (#' . $_product->get_sku() . ')' : '';

	if ( $show_prices )
		echo " (" . $order->get_line_subtotal( $item ) . ")";

	echo " X " . $item['qty'];

	// allow other plugins to add additional product information here
	do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order, $plain_text );

	// Variation
	if ( version_compare( WC_VERSION, '3.0', '<' ) ) {
		echo $item_meta->meta ? ( "\n --> " . str_replace( "\n", '', $item_meta->display( true, true ) ) ) : '';
	} else {
		echo strip_tags( wc_display_item_meta( $item, array(
			'before'    => "\n- ",
			'separator' => "\n- ",
			'after'     => "",
			'echo'      => false,
			'autop'     => false,
		) ) );
	}

	// File URLs
	if ( $show_download_links ) {
		version_compare( WC_VERSION, '3.0.0', '<' ) ? $order->display_item_downloads( $item ) : wc_display_item_downloads( $item );
	}

	// allow other plugins to add additional product information here
	do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order, $plain_text );
	
	echo "\n";

}

echo "\n";

if ( $show_totals ) {

	if ( $triggers['all'] && ( $totals = $order->get_order_item_totals() ) ) {
		foreach ( $totals as $total ) {
			echo $total['label'] . ' ';
			echo preg_replace( "/&#?[a-z0-9]{2,8};/i", "", $total['value'] );
			echo "\n";
		}
	} else {
		// Only show the total for displayed items
		echo __( 'Total', 'woocommerce-advanced-notifications' ) . ': ';
		echo $displayed_total;
		echo "\n";
	}

}

if ( $order->get_customer_note() ) {
	echo __( 'Note', 'woocommerce-advanced-notifications' ) . ': ';
	echo $order->get_customer_note();
	echo "\n";
}

echo "\n\n";

/**
* @hooked WC_Emails::customer_details() Shows customer details
* @hooked WC_Emails::email_address() Shows email address
*/



$thecustomer = $order->get_user();
$user_meta = get_user_meta($thecustomer->ID);
$company = $user_meta['afreg_additional_4148'][0];
$email_address = get_post_meta($order->get_order_number(), '_billing_email', true);
$vat_number = get_post_meta($order->get_order_number(), 'vat_number', true);
$declaration = get_post_meta($order->get_order_number(), 'existing_customer', true);
$custname = $user_meta['first_name'][0] . ' ' . $user_meta['last_name'][0];
$billing_address_1 = $user_meta['billing_address_1'][0];
$billing_address_2 = $user_meta['billing_address_2'][0];
$billing_city = $user_meta['billing_city'][0];
$billing_postcode = $user_meta['billing_postcode'][0];
$billing_country = $user_meta['billing_country'][0];
$ordermethod = $order->get_payment_method_title();

echo "\n\n";
echo "\n\n";

echo "BILLING ADDRESS";

echo "\n\n";

echo "Shopper's Name: " . $custname . "\n";
echo "Shopper's Address: " . $billing_address_1 . "\n";
echo $billing_address_2 . "\n";
echo $billing_city . "\n";
echo "Shopper's Postcode: " . $billing_postcode . "\n";
echo "Shopper's Country: " . $billing_country . "\n";
echo "VAT Number: " . $vat_number . "\n";
echo "Shopper's Email: " . $email_address . "\n";
echo "Payment method: " . $ordermethod;

echo "\n\n";

echo "ORDER METADATA";

echo "\n\n";


echo "Email address:" . " " . $email_address . "\n";
echo "Company name:" . " " . $company . "\n";
echo "VAT number:" . " " . $vat_number . "\n";
echo "Non audit client declaration:" . " " . $declaration;



echo "\n\n";

echo "The above payment has been processed.";