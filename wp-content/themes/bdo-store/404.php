<?php

if ( ! class_exists( 'Timber' ) ) {
	echo 'Timber not activated. Make sure you activate the plugin in <a href="/wordpress/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
	return;
}

if ( ! class_exists( 'acf' ) ) {
	echo '<p>Advanced Custom Fields not activated. Make sure you activate the plugin in <a href="/wordpress/wp-admin/plugins.php#advanced-custom-fields-pro">/wp-admin/plugins.php</a>';
	return;
}

$context = Timber::context();
$context['post'] = new Timber\Post();
Timber::render( 'views/404.twig', $context );

wp_reset_postdata();