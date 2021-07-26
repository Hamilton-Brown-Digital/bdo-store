<?php

// REMOVE SUBTOTAL
add_filter( 'woocommerce_get_order_item_totals', 'remove_subtotal_from_orders_total_lines', 100, 1 );
function remove_subtotal_from_orders_total_lines( $totals ) {
    unset($totals['cart_subtotal']  );
    return $totals;
}

// CHANGE RETURN TO SHOP LINK AND TEXT
add_filter('woocommerce_return_to_shop_text', 'prefix_store_button');
function prefix_store_button() {
        $store_button = "Return to Store";
        return $store_button;
}

add_filter( 'woocommerce_return_to_shop_redirect', 'store_mall_wc_empty_cart_redirect_url' );
function store_mall_wc_empty_cart_redirect_url() {
    $url = '/';
    return esc_url( $url );
}

// REMOVE VARIATION STUFF FROM NAME
add_filter( 'woocommerce_product_variation_title_include_attributes', '__return_false' );