<?php

/**
 * @desc Stop WordPress inserting Hello World and Sample pages on install
 */

add_action( 'wpmu_new_blog', 'delete_wordpress_defaults', 10, 6 );
add_action( 'after_switch_theme', 'delete_wordpress_defaults', 10, 6 );

function delete_wordpress_defaults( $blog_id ) {

  // Find and delete the WP default 'Sample Page'
  $defaultPage = get_page_by_title( 'Sample Page' );
  wp_delete_post( $defaultPage->ID, $bypass_trash = true );

  // Find and delete the WP default 'Hello world!' post
  $defaultPost = get_posts( array( 'title' => 'Hello World!' ) );
  wp_delete_post( $defaultPost[0]->ID, $bypass_trash = true );

}

/**
 * @desc We will automatically set the permalink structure
 */

function update_permalinks() {

  if ( get_option( 'permalink_structure' ) == '' ) {
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure( '/%postname%' );
    $wp_rewrite->flush_rules();
  }

}

add_action( 'after_switch_theme', 'update_permalinks' );


/**
 * @desc stop validation messages on login
*/

function no_wordpress_errors(){
  return 'You have entered an invalid username or password';
}
add_filter( 'login_errors', 'no_wordpress_errors' );