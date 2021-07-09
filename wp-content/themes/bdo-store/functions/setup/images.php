<?php

add_theme_support( "title-tag" );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );

/**
 * Image Size wordpress documentation on function use:
 * @link https://developer.wordpress.org/reference/functions/add_image_size/
 */

function image_sizes() {
  add_image_size( 'banner', 1980 );
}

add_action( 'after_setup_theme', 'image_sizes' );
