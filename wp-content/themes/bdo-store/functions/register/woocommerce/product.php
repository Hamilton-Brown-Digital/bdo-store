<?php

// Remove default woo styles
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// Remove image from product pages
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );

// Remove title from product pages
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

// Remove price from product pages
add_filter('woocommerce_variable_price_html','custom_from',10);
add_filter('woocommerce_grouped_price_html','custom_from',10);
add_filter('woocommerce_variable_sale_price_html','custom_from',10);
function custom_from($price){
    return false;
}

// Remove summary from product pages
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

// Remove meta from product pages
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

// remove related
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

// Remove product thumbnail from the cart page
add_filter( 'woocommerce_cart_item_thumbnail', '__return_empty_string' );

// To change cart text to basket
add_filter('gettext', 'cartToBasket', 20, 3);
function cartToBasket ( $translated_text, $text, $domain ) {
    if ($domain == 'woocommerce') {
        switch ($translated_text) {
            case 'Cart totals':
                $translated_text = __('Order summary', 'woocommerce');
                break;
            case 'Update cart':
                $translated_text = __('Update basket', 'woocommerce');
                break;
            case 'Add to cart':
                $translated_text = __('Add to basket', 'woocommerce');
                break;
            case 'View cart':
                $translated_text = __('View basket', 'woocommerce');
                break;
        }
    }
    return $translated_text;
}