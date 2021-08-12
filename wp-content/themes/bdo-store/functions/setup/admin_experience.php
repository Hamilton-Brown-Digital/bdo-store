<?php

/**
 * @desc Custom login screen
 */
function wpb_login_logo() { ?>
    <style type="text/css">
		@font-face {
			font-family: 'Proxima Nova Regular';
			font-style: normal;
			font-weight: normal;
			src: url('<?php echo get_template_directory_uri() ?>/assets/src/fonts/proximanovareg.woff2') format('woff2'),
				url('<?php echo get_template_directory_uri() ?>/assets/src/fonts/proximanovareg.woff') format('woff');
		}
		@font-face {
			font-family: 'Proxima Nova Bold';
			font-style: normal;
			font-weight: normal;
			src: url('<?php echo get_template_directory_uri() ?>/assets/src/fonts/proximanovabold.woff2') format('woff2'),
				url('<?php echo get_template_directory_uri() ?>/assets/src/fonts/proximanovabold.woff') format('woff');
		}
		#login p, #login input, #login label, #login a{
			font-family:'Proxima Nova Regular';
		}
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_template_directory_uri() ?>/assets/src/img/logo.svg);
        height:100px;
        width:300px;
        background-size: 300px 100px;
        background-repeat: no-repeat;
        padding-bottom: 10px;
        }
		#login #wp-submit{
			border-radius:0;
			background-color:#ed1a3b;
			border:none;
		}
		#login input{
			border:2px solid #707070;
			border-radius:0;
			font-size:16px;
		}
		#login input[type="submit"]{
			font-size:16px;
			font-family:'Proxima Nova Bold';
			padding:.5em 1.5em;
			min-height:unset;
			line-height:unset;
		}
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'wpb_login_logo' );



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