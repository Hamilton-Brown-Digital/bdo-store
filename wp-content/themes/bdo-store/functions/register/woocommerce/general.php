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

add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );
function remove_admin_bar_links() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('view-store');
}

// HIDE ADMIN MENU FOR SHOP MANAGER
function is_shop_manager() {
    $user = wp_get_current_user();
    if ( in_array('shop_manager', $user->roles) ) {
        return true;
    } else {
        return false;
    }
}

add_action('admin_menu', 'remove_shop_manager_menus', 9999);
function remove_shop_manager_menus() {
    if ( is_shop_manager() ) {
        remove_menu_page( 'index.php' );                                //Dashboard
        remove_menu_page( 'upload.php' );                               //Media
        remove_menu_page( 'edit.php?post_type=page' );                  //Pages
        remove_menu_page( 'themes.php' );                               //Appearance
        remove_menu_page( 'plugins.php' );                              //Plugins
        remove_menu_page( 'users.php' );                                //Users
        remove_menu_page( 'tools.php' );                                //Tools
        remove_menu_page( 'options-general.php' );                      //Settings
        remove_menu_page( 'gf_edit_forms' );                            //Gravity Forms
        remove_menu_page( 'edit.php?post_type=gated' );                 //Gated
        remove_menu_page( 'store-options' );                            //Theme Options
        remove_menu_page( 'wpseo_dashboard' );                          //Yoast
        remove_menu_page( 'edit.php?post_type=acf-field-group' );       //ACF
        remove_menu_page( 'customer-emails' );                          // Customer emails
        remove_menu_page( 'edit.php?post_type=product' );               //Product
        remove_menu_page('wc-admin&path=/analytics/overview');          //Analytics
        remove_menu_page('woocommerce-marketing');                      //Marketing
        remove_menu_page('ai1wm_export');                               //All In One WP Migration

        remove_submenu_page('woocommerce', 'wc-admin');                 //Woo Home
        remove_submenu_page('woocommerce', 'coupons-moved');            //Woo Coupons
        remove_submenu_page('woocommerce', 'wc-reports');               //Woo Reports
        remove_submenu_page('woocommerce', 'wc-settings');              //Woo Settings
        remove_submenu_page('woocommerce', 'wc-status');                //Woo Status
        remove_submenu_page('woocommerce', 'wc-addons');                //Woo Addons
    }
}

add_filter('login_redirect', 'admin_default_page');
function admin_default_page() {
    if ( is_shop_manager() ) {
        return '/wp-admin/edit.php?post_type=shop_order';
    }
}

add_filter( 'login_redirect', 'login_redirect', 10, 3 );
function login_redirect( $redirect_to, $request, $user ) {
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {
        if ( in_array( 'administrator', $user->roles ) || in_array( 'editor', $user->roles ) || in_array( 'author', $user->roles ) ) {
            $redirect_to = admin_url();
        } else if ( in_array( 'customer', $user->roles ) || in_array( 'shop_manager', $user->roles ) ) {
            $redirect_to = admin_url() . 'edit.php?post_type=shop_order';
        } else {
            $redirect_to = home_url();
        }
        return $redirect_to;
    }
}

// WRAP MESSAGE TEXT IN P TAGS
add_filter('wc_add_to_cart_message_html', 'handler_function_name', 10, 2);
function handler_function_name($message, $products) {
    $titles = array();

    foreach ( $products as $product_id => $qty ) {
        $titles[] = strip_tags( get_the_title( $product_id ) );
    }

    $titles = array_filter( $titles );
    $added_text = 'Successfully added to your basket.';

    // Output success messages
    if ( 'yes' === get_option( 'woocommerce_cart_redirect_after_add' ) ) {
        $return_to = apply_filters( 'woocommerce_continue_shopping_redirect', wc_get_raw_referer() ? wp_validate_redirect( wc_get_raw_referer(), false ) : '/' );
        $message   = sprintf( '%s <a href="%s" class="button wc-forward">%s</a>', '<p>Successfully added to your basket.</p>',  esc_url( $return_to ), esc_html__( 'Continue shopping', 'woocommerce' ) );
    } else {
        $message   = sprintf( '%s <a href="%s" class="button wc-forward">%s</a>', '<p>Successfully added to your basket.</p>', esc_url( wc_get_page_permalink( 'cart' ) ), esc_html__( 'View basket', 'woocommerce' ) );
    }
    return $message;
}

add_filter( 'woocommerce_cart_product_cannot_add_another_message', 'notAnotherInCart', 10, 2 );
function notAnotherInCart( $message, $product_data ){
	$message = '<p>Another one of these cannot be added to your basket</p>';

	return $message;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'woo_cart_count_fragments', 10, 1 );
function woo_cart_count_fragments( $fragments ) {
    if ( WC()->cart->get_cart_contents_count() > 0 ) {
        $fragments['span.basket_count'] = '<span class="basket_count">(' . WC()->cart->get_cart_contents_count() . ')</span>';
    } else {
        $fragments['span.basket_count'] = '<span class="basket_count"></span>';
    }
    return $fragments;
}