<?php

if ( ! class_exists( 'Timber' ) ) {
	echo 'Timber not activated. Make sure you activate the plugin in <a href="/wordpress/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
	return;
}

if ( ! class_exists( 'acf' ) ) {
	echo '<p>Advanced Custom Fields not activated. Make sure you activate the plugin in <a href="/wordpress/wp-admin/plugins.php#advanced-custom-fields-pro">/wp-admin/plugins.php</a>';
	return;
}

if( is_cart() ) {

    $context = Timber::context();
	$context['post'] = new Timber\Post();
    Timber::render('views/woo/page-basket.twig', $context);

    wp_reset_postdata();

} else if( is_checkout() ) {

	$context = Timber::context();
	$context['post'] = new Timber\Post();
	Timber::render('views/woo/page-checkout.twig', $context);

	wp_reset_postdata();

} else if( is_account_page() ) {

	$context = Timber::context();
	$context['post'] = new Timber\Post();
	$context['user'] = new Timber\User();
	Timber::render('views/woo/page-account.twig', $context);
	
	wp_reset_postdata();

} else {

	$context = Timber::context();
	$context['post'] = new Timber\Post();
	Timber::render( 'views/index.twig', $context );

	wp_reset_postdata();

}