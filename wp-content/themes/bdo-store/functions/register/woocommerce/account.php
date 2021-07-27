<?php




  add_action( 'init', 'my_account_new_endpoints' );
  function my_account_new_endpoints() {
      add_rewrite_endpoint( 'welcome', EP_ROOT | EP_PAGES );
  }

  /**
  * Get new endpoint content
  */

  // welcome
 add_action( 'woocommerce_account_welcome_endpoint', 'welcome_endpoint_content' );
 function welcome_endpoint_content() {
    get_template_part( 'woocommerce/myaccount/welcome' );
 }


// remove order again button
remove_action( 'woocommerce_order_details_after_order_table', 'woocommerce_order_again_button' );

// Remove or rename Account pages
add_filter( 'woocommerce_account_menu_items', 'woo_change_account_page', 9999 );
function woo_change_account_page( $items ) {
    unset( $items['downloads'] );
    unset( $items['payment-methods'] );

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



