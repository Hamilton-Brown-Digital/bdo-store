<?php

//  ***** ***** ***** ***** ***** ***** ***** ***** ***** ***** ***** *****  //

//  This file creates any custom taxonomies we need for our theme. Get started
//  by un-commenting everything below, and customizing the taxonomy to suit.

//  ***** ***** ***** ***** ***** ***** ***** ***** ***** ***** ***** *****  //

// function create_prop_taxonomies() {


// 	register_taxonomy(
// 		'Menus', //  Your taxonomy title  //
// 		'menus',   //  The Custom Post Type it will belong to  //
// 		array(
// 			'hierarchical' => true,
// 			'label'        => 'All Menus',
// 			'query_var'    => true,
// 			'rewrite'      => array( 'slug' => 'all-menus' )
// 		)
// 	);

// 	//  Add the next taxonomy here  //

// 	flush_rewrite_rules();
// }

// add_action( 'init', 'create_prop_taxonomies' );