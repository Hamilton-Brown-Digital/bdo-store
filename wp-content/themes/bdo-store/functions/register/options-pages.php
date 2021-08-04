<?php

//  ***** ***** ***** ***** ***** ***** ***** ***** ***** ***** ***** *****  //

//  This file adds an Options Page for the backend
//
//  [_1_] Create the First Options Page

//  ***** ***** ***** ***** ***** ***** ***** ***** ***** ***** ***** *****  //


//  [_1_] Create the First Options Page  //

if( function_exists('acf_add_options_page') ) {

    $parent = acf_add_options_page(array(
        'page_title'  => 'Store Options',
        'menu_title'  => 'Store Options',
        'menu_slug'   => 'store-options',
        'capability'  => 'edit_posts',
        'redirect'    => false,
        'icon_url'    => 'dashicons-forms',
        'position'    => 22,
    ));
    $parent = acf_add_options_page(array(
        'page_title'  => 'Customer Emails',
        'menu_title'  => 'Customer Emails',
        'menu_slug'   => 'customer-emails',
        'capability'  => 'edit_posts',
        'redirect'    => false,
        'icon_url'    => 'dashicons-email',
        'position'    => 23,
    ));

    // $child = acf_add_options_sub_page(array(
    //     'page_title'  => 'Socials',
    //     'menu_title'  => 'Socials',
    //     'menu_slug'   => 'socials',
    //     'parent_slug' => $parent['menu_slug'],
    // ));

}
