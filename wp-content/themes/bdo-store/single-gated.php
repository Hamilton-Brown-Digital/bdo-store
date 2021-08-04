<?php

if (!class_exists('Timber')) {
    echo 'Timber not activated. Make sure you activate the plugin in <a href="/wordpress/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
    return;
}

if (!class_exists('acf')) {
    echo '<p>Advanced Custom Fields not activated. Make sure you activate the plugin in <a href="/wordpress/wp-admin/plugins.php#advanced-custom-fields-pro">/wp-admin/plugins.php</a>';
    return;
}

$loggedIn = is_user_logged_in();

$context = Timber::context();
$context['logged_in'] = $loggedIn;
$context['purchased'] = false;
$context['post'] = new Timber\Post();

if ( $loggedIn ) {
    $current_user = wp_get_current_user();

    $args = array(
        'post_type'    => 'product',
        'meta_key'     => 'gated_page',
        'meta_value'   => get_the_ID(),
        'posts_per_page' => 1,
        'fields' => 'ids'
    );
    $productId = get_posts( $args );





    function has_bought() {
        // Get all customer orders
        $customer_orders = get_posts( array(
            'numberposts' => 1,
            'meta_key'    => '_customer_user',
            'meta_value'  => get_current_user_id(),
            'post_type'   => 'shop_order',
            'post_status' => array('passed-stripe','inv-payment-made'),
            'fields'      => 'ids', // Return Ids "completed"
        ) );
        return count($customer_orders) > 0 ? true : false;
    }
    
    if (has_bought()){
        $context['purchased'] = true;
    } else {
        $context['purchased'] = false;
    }

}

Timber::render('views/woo/single-gated.twig', $context);

wp_reset_postdata();