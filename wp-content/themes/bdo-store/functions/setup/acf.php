<?php

add_filter('acf/settings/load_json', 'my_acf_json_load_point');

function my_acf_json_load_point($paths)
{
    unset($paths[0]);

    $paths[] = get_template_directory() . '/acf-json';

    return $paths;

}

add_filter('mce_buttons_2', 'myplugin_tinymce_buttons');

function myplugin_tinymce_buttons($buttons)
{
    //Add style selector to the beginning of the toolbar
    array_unshift($buttons, 'styleselect');

    return $buttons;
}

/// WYSIWYG - TinyMCe
add_filter('tiny_mce_before_init', 'tiny_mce_remove_unused_formats');

function tiny_mce_remove_unused_formats($init)
{
    // Add block format elements you want to show in dropdown
    $init['block_formats'] = 'Paragraph=p; Heading 2=h2; Heading 3=h3; Heading 4 =h4; Heading 5=h5;';
    // $init['block_formats'] = 'Lead Paragraph=p';
    return $init;
}