<?php

// Remove default woo styles
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// Remove image from product pages
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );

// Remove title from product pages
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

// Remove price from product pages
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

// Remove summary from product pages
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

// Remove meta from product pages
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

// Remove product thumbnail from the cart page
add_filter( 'woocommerce_cart_item_thumbnail', '__return_empty_string' );

// To change add to cart text on single product page
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' ); 
function woocommerce_custom_single_add_to_cart_text() {
    return __( 'Add to basket', 'woocommerce' ); 
}