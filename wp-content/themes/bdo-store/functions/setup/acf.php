<?php

add_filter('acf/settings/load_json', 'my_acf_json_load_point');

function my_acf_json_load_point($paths)
{
    unset($paths[0]);

    $paths[] = get_template_directory() . '/acf-json';

    return $paths;

}

add_filter('mce_buttons', 'tinymce_buttons');
function tinymce_buttons($buttons) {
    unset($buttons[5]);
    unset($buttons[6]);
    unset($buttons[7]);
    unset($buttons[8]);
    unset($buttons[10]);
    unset($buttons[11]);
    unset($buttons[12]);
    unset($buttons[13]);

    return $buttons;
}

add_filter('mce_buttons_2', 'tinymce_2_buttons');
function tinymce_2_buttons($buttons) {
    $buttons = [];
    return $buttons;
}


add_filter('tiny_mce_before_init', 'tiny_mce_remove_unused_formats');
function tiny_mce_remove_unused_formats($init) {
    $init['block_formats'] = 'Paragraph=p; Heading 3=h3; Heading 4=h4; Heading 5=h5;';
    return $init;
}

function acf_set_product_categories($field) {
    $field['choices'] = array();

    $args = array(
        'taxonomy'   => "product_cat",
        'hide_empty' => false
    );
    $product_categories = get_terms($args);

    if ( !empty($product_categories) ) {

        $field['choices']['none'] = 'None';

        foreach( $product_categories as $tax ) {

            $value = $tax->term_id;
            $label = $tax->name;
            
            $field['choices'][$value] = $label;

        }

    } 

    return $field;
}

add_filter('acf/load_field/name=product_category', 'acf_set_product_categories');