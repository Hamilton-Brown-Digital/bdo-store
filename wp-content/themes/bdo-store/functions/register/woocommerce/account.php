<?php

// Remove or rename Account pages
add_filter( 'woocommerce_account_menu_items', 'woo_change_account_page', 9999 );
function woo_change_account_page( $items ) {
    unset( $items['downloads'] );

    $items['dashboard'] = 'My products';
    $items['orders'] = 'Order history';

    return $items;
}

// Validate - my account
function action_woocommerce_save_account_details_errors( $args ){
    if ( isset( $_POST['account_billing_company'] ) && empty( $_POST['account_billing_company'] ) ) {
        $args->add( 'error', __( 'Please provide a company name', 'woocommerce' ) );
    }
}
add_action( 'woocommerce_save_account_details_errors','action_woocommerce_save_account_details_errors', 10, 1 );

// Save - my account
function action_woocommerce_save_account_details( $user_id ) {  
    if( isset( $_POST['account_billing_company'] ) && ! empty( $_POST['account_billing_company'] ) ) {
        update_user_meta( $user_id, 'billing_company', sanitize_text_field( $_POST['account_billing_company'] ) );
    }
}
add_action( 'woocommerce_save_account_details', 'action_woocommerce_save_account_details', 10, 1 );