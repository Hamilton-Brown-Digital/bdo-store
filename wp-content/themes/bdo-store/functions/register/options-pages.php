<?php

//  ***** ***** ***** ***** ***** ***** ***** ***** ***** ***** ***** *****  //

//  This file adds an Options Page for the backend
//
//  [_1_] Create the First Options Page

//  ***** ***** ***** ***** ***** ***** ***** ***** ***** ***** ***** *****  //


//  [_1_] Create the First Options Page  //

if( function_exists('acf_add_options_page') ) {

    $parent = acf_add_options_page(array(
        'page_title'  => 'Theme Options',
        'menu_title'  => 'Theme Options',
        'menu_slug'   => 'theme-options',
        'capability'  => 'edit_posts',
        'redirect'    => false,
        'icon_url'    => 'dashicons-forms',
        'position'    => 22,
    ));

    // $child = acf_add_options_sub_page(array(
    //     'page_title'  => 'Socials',
    //     'menu_title'  => 'Socials',
    //     'menu_slug'   => 'socials',
    //     'parent_slug' => $parent['menu_slug'],
    // ));

}
