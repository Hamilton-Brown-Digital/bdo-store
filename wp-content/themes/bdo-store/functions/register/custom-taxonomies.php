<?php

//  ***** ***** ***** ***** ***** ***** ***** ***** ***** ***** ***** *****  //

//  This file creates any custom taxonomies we need for our theme. Get started
//  by un-commenting everything below, and customizing the taxonomy to suit.

//  ***** ***** ***** ***** ***** ***** ***** ***** ***** ***** ***** *****  //

// function create_prop_taxonomies() {

// 	register_taxonomy(
// 		'product-group', //  Your taxonomy title  //
// 		'product',   //  The Custom Post Type it will belong to  //
// 		array(
// 			'hierarchical' => true,
// 			'label'        => 'Product Group',
// 			'query_var'    => true,
// 			'rewrite'      => array( 'slug' => 'product-group' )
// 		)
// 	);

// 	//  Add the next taxonomy here  //

// 	flush_rewrite_rules();
// }

// add_action( 'init', 'create_prop_taxonomies' );