<?php

function wc_edit_checkout_fields( $fields ) {

    // Billing fields
    unset( $fields['billing']['billing_company'] );
    // unset( $fields['billing']['billing_email'] );
    // unset( $fields['billing']['billing_phone'] );
    // unset( $fields['billing']['billing_state'] );
    // unset( $fields['billing']['billing_first_name'] );
    // unset( $fields['billing']['billing_last_name'] );
    // unset( $fields['billing']['billing_address_1'] );
    unset( $fields['billing']['billing_address_2'] );
    unset( $fields['billing']['billing_address_2'] );
    $fields['billing']['billing_address_2']['label'] = 'DO ONEEEE!!!!!!!!!!!!!!';
    $fields['billing']['billing_address_2']['placeholder'] = 'My new placeholder';
    // unset( $fields['billing']['billing_city'] );
    // unset( $fields['billing']['billing_postcode'] );
    // Order fields
    // unset( $fields['order']['order_comments'] );

    return $fields;
}
add_filter( 'woocommerce_checkout_fields', 'wc_edit_checkout_fields' );



 // $fields['billing']['billing_company']['placeholder'] = 'Business Name';
 // $fields['billing']['billing_company']['label'] = 'Business Name';
 // $fields['billing']['billing_first_name']['placeholder'] = 'First Name'; 
 // $fields['shipping']['shipping_first_name']['placeholder'] = 'First Name';
 // $fields['shipping']['shipping_last_name']['placeholder'] = 'Last Name';
 // $fields['shipping']['shipping_company']['placeholder'] = 'Company Name'; 
 // $fields['billing']['billing_last_name']['placeholder'] = 'Last Name';
 // $fields['billing']['billing_email']['placeholder'] = 'Email Address ';
 // $fields['billing']['billing_phone']['placeholder'] = 'Phone ';


?>