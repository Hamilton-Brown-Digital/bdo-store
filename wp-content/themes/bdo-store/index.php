<?php

if ( ! class_exists( 'Timber' ) ) {
	echo 'Timber not activated. Make sure you activate the plugin in <a href="/wordpress/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
	return;
}

if ( ! class_exists( 'acf' ) ) {
	echo '<p>Advanced Custom Fields not activated. Make sure you activate the plugin in <a href="/wordpress/wp-admin/plugins.php#advanced-custom-fields-pro">/wp-admin/plugins.php</a>';
	return;
}

$post = new TimberPost();

$context = Timber::get_context();
$context['post'] = $post;

$templates = array( 'index.twig' );
Timber::render( $templates, $context );
