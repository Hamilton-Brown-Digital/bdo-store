<?php

//  ***** ***** ***** ***** ***** ***** ***** ***** ***** ***** ***** *****  //

//  This file creates any custom post types we need for our theme. Get started
//  by un-commenting everything below, and customizing the cpt to suit.

//  ***** ***** ***** ***** ***** ***** ***** ***** ***** ***** ***** *****  //

function create_prop_post_types()
{

    $labels = array(
        'name' => _x('Gated Pages', 'Post Type General Name', 'text_domain'),
        'singular_name' => _x('Gated Page', 'Post Type Singular Name', 'text_domain'),
        'menu_name' => __('Gated Pages', 'text_domain'),
        'name_admin_bar' => __('Gated Pages', 'text_domain'),
        'archives' => __('Item Archives', 'text_domain'),
        'parent_item_colon' => __('Parent Gated Page:', 'text_domain'),
        'all_items' => __('All Gated Pages', 'text_domain'),
        'add_new_item' => __('Add New Gated Page', 'text_domain'),
        'add_new' => __('Add New Gated Page', 'text_domain'),
        'new_item' => __('New Gated Page', 'text_domain'),
        'edit_item' => __('Edit Gated Page', 'text_domain'),
        'update_item' => __('Update Gated Page', 'text_domain'),
        'view_item' => __('View Gated Page', 'text_domain'),
        'search_items' => __('Search Gated Pages', 'text_domain'),
        'not_found' => __('Not found', 'text_domain'),
        'not_found_in_trash' => __('Not found in Trash', 'text_domain'),
        'featured_image' => __('Gated Page Featured Image', 'text_domain'),
        'set_featured_image' => __('Set Gated Page Featured image', 'text_domain'),
        'remove_featured_image' => __('Remove Gated Page Featured image', 'text_domain'),
        'use_featured_image' => __('Use as Gated Page Featured image', 'text_domain'),
        'insert_into_item' => __('Insert into item', 'text_domain'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'text_domain'),
        'items_list' => __('Gated Pages list', 'text_domain'),
        'items_list_navigation' => __('Gated Pages list navigation', 'text_domain'),
        'filter_items_list' => __('Filter Gated Pages list', 'text_domain'),
    );

    $args = array(
        'label' => __('Gated Pages', 'text_domain'),
        'description' => __('Gated Pages', 'text_domain'),
        'labels' => $labels,
        'supports' => array('thumbnail', 'editor', 'title', 'revisions'),
        'taxonomies' => array(),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-admin-network',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );

    register_post_type('gated', $args);

    //  Register any additional CPTs here  //

    flush_rewrite_rules();
}

add_action('init', 'create_prop_post_types');