<?php

add_filter( 'wp_terms_checklist_args', 'woo_term_radio_checklist' );
function woo_term_radio_checklist( $args ) {
    if ( ! empty( $args['taxonomy'] ) && $args['taxonomy'] === 'product_cat' ) {
        if ( empty( $args['walker'] ) || is_a( $args['walker'], 'Walker' ) ) {
            if ( ! class_exists( 'Woo_Walker_Category_Radio_Checklist' ) ) {
                class Woo_Walker_Category_Radio_Checklist extends Walker_Category_Checklist {
                    function walk( $elements, $max_depth, ...$args ) {
                        $output = parent::walk( $elements, $max_depth, ...$args );
                        $output = str_replace(
                            array( 'type="checkbox"', "type='checkbox'" ),
                            array( 'type="radio"', "type='radio'" ),
                            $output
                        );

                        return $output;
                    }
                }
            }
            $args['walker'] = new Woo_Walker_Category_Radio_Checklist;
        }
    }
    return $args;
}
