<?php

/**
 * @desc Remove the default post/page editor
 */
function remove_editor() {
	remove_post_type_support('page', 'editor');
	remove_post_type_support('post', 'editor');
	remove_post_type_support('product', 'editor');
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


// change Howdy message

add_filter( 'admin_bar_menu', 'replace_wordpress_howdy', 25 );
	function replace_wordpress_howdy( $wp_admin_bar ) {
		$my_account = $wp_admin_bar->get_node('my-account');
		$newtext = str_replace( 'Howdy,', 'Hello,', $my_account->title );
		$wp_admin_bar->add_node( array(
		'id' => 'my-account',
		'title' => $newtext,
	) );
}