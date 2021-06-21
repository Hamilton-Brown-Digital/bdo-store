<?php

/**
 * @desc Remove the default post/page editor
 */
function remove_editor() {
  remove_post_type_support('page', 'editor');
  remove_post_type_support('post', 'editor');
}
add_action('admin_init', 'remove_editor');


/**
 *  @desc Push Yoast to the bottom
 */
add_filter( 'wpseo_metabox_prio', function() { return 'low';});


add_filter( 'tiny_mce_before_init', 'override_mp6_tinymce_styles' );
function override_mp6_tinymce_styles( $mce_init ) {

	// make sure we don't override other custom <code>content_css</code> files
	$content_css = get_stylesheet_directory_uri() . '/assets/src/admin-style.css';
	if ( isset( $mce_init[ 'content_css' ] ) )
	$content_css .= ',' . $mce_init[ 'content_css' ];

	$mce_init[ 'content_css' ] = $content_css;

	return $mce_init;

}