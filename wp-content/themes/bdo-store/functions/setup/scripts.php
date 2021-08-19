<?php

function head() {

	wp_register_style( 'main', get_stylesheet_directory_uri() . '/assets/dist/style.css', false );
	wp_enqueue_script( 'cookiebot', 'https://consent.cookiebot.com/uc.js' );
	wp_enqueue_style( 'main' );

	function addatts( $tag, $handle, $src ) {
		if ('cookiebot' == $handle){
			$tag = '<script type="text/javascript" src="' . esc_url( $src ) . '" data-cbid="87a51d12-ebd0-4d3d-bf5d-ead8383f9764" data-blockingmode="auto"></script>';
		}
		return $tag;
	}
	add_filter( 'script_loader_tag', 'addatts', 10, 3 );

}

function footer() {

	// if ( ! is_admin() ) {
	// 	wp_deregister_script( 'jquery' );
	// }

	wp_deregister_script( 'wp-embed' );

	if (function_exists('is_wpe') && is_wpe()) {
		wp_enqueue_script( 'main-js', get_template_directory_uri() . '/assets/dist/scripts.min.js', [], filemtime( get_template_directory() . '/assets/dist/scripts.min.js' ), true );
	} else {
		wp_enqueue_script( 'main-js', get_template_directory_uri() . '/assets/dist/scripts.min.js', []);
	}

	wp_enqueue_script( 'main-js' );

}

function acf_admin() {

	if (function_exists('is_wpe') && is_wpe()) {
		wp_enqueue_script( 'admin-js', get_template_directory_uri() . '/assets/dist/admin.min.js', false, filemtime( get_template_directory() . '/assets/dist/admin.min.js' ), true );
	} else {
		wp_enqueue_script( 'admin-js', get_template_directory_uri() . '/assets/dist/admin.min.js', false );
	}

	wp_enqueue_script( 'admin-js' );

}

add_action( 'wp_enqueue_scripts', 'head' );
add_action( 'wp_enqueue_scripts', 'footer' );
add_action( 'acf/input/admin_enqueue_scripts', 'acf_admin' );


/**
 * @desc add defer to scripts.min.js
 */

function add_defer_attribute( $tag, $handle ) {
	if ( 'main-js' !== $handle ) {
		return $tag;
	}

	return str_replace( ' src', ' defer src', $tag );
}

add_filter( 'script_loader_tag', 'add_defer_attribute', 10, 2 );