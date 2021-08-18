<?php

  function my_account_new_endpoints() {
      add_rewrite_endpoint( 'welcome', EP_ROOT | EP_PAGES );
  }
  add_action( 'init', 'my_account_new_endpoints' );

// welcome
 function welcome_endpoint_content() {
    get_template_part( 'woocommerce/myaccount/welcome' );
 }
 add_action( 'woocommerce_account_welcome_endpoint', 'welcome_endpoint_content' );


// remove order again button
remove_action( 'woocommerce_order_details_after_order_table', 'woocommerce_order_again_button' );

// Remove or rename Account pages
function woo_change_account_page( $items ) {
    unset( $items['downloads'] );
    unset( $items['payment-methods'] );
    $items['dashboard'] = 'My products';
    $items['orders'] = 'Order history';

    return $items;
}
add_filter( 'woocommerce_account_menu_items', 'woo_change_account_page', 9999 );

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



function before_account_orders (){
    echo "<h2 class='c-account__page-title'>Order History</h2>";
}
add_action('woocommerce_before_account_orders', 'before_account_orders', 10, 1 );

function before_address_form (){
    echo "<h2 class='c-account__page-title'>Address</h2>";
}
add_action('woocommerce_before_edit_account_address_form', 'before_address_form', 10, 1 ); 

function before_edit_account_form (){
    echo "<h2 class='c-account__page-title'>Account details</h2>";
}
add_action('woocommerce_before_edit_account_form', 'before_edit_account_form', 10, 1 ); 