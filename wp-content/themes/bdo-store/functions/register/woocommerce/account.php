<?php

// Remove or rename Account pages
add_filter( 'woocommerce_account_menu_items', 'woo_change_account_page', 9999 );
function woo_change_account_page( $items ) {
    unset( $items['downloads'] );

    $items['dashboard'] = 'My products';
    $items['orders'] = 'Order history';

    return $items;
}