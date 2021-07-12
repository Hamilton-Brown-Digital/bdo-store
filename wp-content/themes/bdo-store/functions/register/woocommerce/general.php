<?php

// ADD CHARGE CODE ORDER IN BACKEND
add_action( 'woocommerce_before_order_itemmeta', 'woo_order_charge_code', 10, 3 );
function woo_order_charge_code( $item_id, $item, $product ){
    if( ! ( is_admin() && $item->is_type('line_item') ) ) return;
    if( $acf_value = get_field( 'charge_code', $product->get_id() ) ) {
        $acf_label = __('<strong>Charge Code:</strong> ');
        echo '<div class="wc-order-item-custom" style="color: #888;">' . $acf_label . $acf_value . '</div>';
    }
}


// ADD CHARGE CODE TO STRIPE META DATA
add_filter( 'wc_stripe_payment_metadata', 'stripe_payment_metadata_filter_callback', 10, 3 );
function stripe_payment_metadata_filter_callback( $metadata, $order, $prepared_source ) {
    foreach ( $order->get_items() as $item ) {
        $product_id = $item['product_id'];

        if (get_field('charge_code',  $product_id)) {
            $metadata[ __( 'charge_code', 'woocommerce-gateway-stripe' ) ] = get_field('charge_code',  $product_id);
        }
    }

    return $metadata;
}