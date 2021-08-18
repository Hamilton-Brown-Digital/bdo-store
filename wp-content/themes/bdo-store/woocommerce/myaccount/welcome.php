<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

Timber::render('views/woo/welcome.twig');

wp_reset_postdata();