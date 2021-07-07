<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<?php

if (!class_exists('Timber')) {
    echo 'Timber not activated. Make sure you activate the plugin in <a href="/wordpress/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
    return;
}

if (!class_exists('acf')) {
    echo '<p>Advanced Custom Fields not activated. Make sure you activate the plugin in <a href="/wordpress/wp-admin/plugins.php#advanced-custom-fields-pro">/wp-admin/plugins.php</a>';
    return;
}

$orders = wc_get_orders( array(
    'numberposts' => -1
    // 'status' => 'completed'
) );

$gated = array();

foreach( $orders as $order ) {
    foreach ( $order->get_items() as $item ) {
        $prodID = $item->get_product_id();
        array_push($gated, array(
            'gate' => get_field('gated_page', $prodID),
            'status' => $order->get_status()
        ) );
    }
}

$context = Timber::context();
$context['post'] = new Timber\Post();
$context['gated'] = $gated;

Timber::render('views/woo/dashboard.twig', $context);

wp_reset_postdata();
