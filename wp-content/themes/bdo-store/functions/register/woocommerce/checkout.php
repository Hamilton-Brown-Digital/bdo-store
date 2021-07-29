<?php

function wc_remove_checkout_fields( $fields ) {

    // Billing fields
    unset( $fields['billing']['billing_company'] );
    // unset( $fields['billing']['billing_email'] );
    // unset( $fields['billing']['billing_phone'] );
    // unset( $fields['billing']['billing_state'] );
    // unset( $fields['billing']['billing_first_name'] );
    // unset( $fields['billing']['billing_last_name'] );
    // unset( $fields['billing']['billing_address_1'] );
    // unset( $fields['billing']['billing_address_2'] );
    // unset( $fields['billing']['billing_city'] );
    // unset( $fields['billing']['billing_postcode'] );

    // Order fields
    // unset( $fields['order']['order_comments'] );

    return $fields;
}
add_filter( 'woocommerce_checkout_fields', 'wc_remove_checkout_fields' );

?>