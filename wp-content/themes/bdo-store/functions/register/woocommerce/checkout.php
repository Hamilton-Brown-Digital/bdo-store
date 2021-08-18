<?php

// // Before checkout
// function before_checkout(){
//     if (! is_user_logged_in()){
//         echo '<p class="returning-customer">Returning customer? <a href=" ' . get_site_url() . '/account/ ">click here to login</a></p>';
//     } else {
//         return;
//     }
// }
// add_action('woocommerce_before_checkout_form', 'before_checkout', 5);


// Edit fields
function wc_edit_checkout_fields( $fields ) {
    unset( $fields['account_last_name'] );
    $fields['billing']['billing_company']['required'] = true;
    return $fields;
}
add_filter( 'woocommerce_checkout_fields', 'wc_edit_checkout_fields' );



// Remove label and placeholder from address field 2
function custom_default_address_fields( $address_fields ) {
    $address_fields['address_2']['label'] = '';
    $address_fields['address_2']['placeholder'] = '';
    $address_fields['postcode']['label'] = 'Postcode';
    return $address_fields;
    
}
add_filter( 'woocommerce_default_address_fields', 'custom_default_address_fields' );






// ----- Add new fields into the checkout page
// ------------------------------------------------

    // 1. Add in required fields
    function custom_checkout_fields( $checkout ) {
        woocommerce_form_field( 'custom_existing_audit_client', array(
            'type' => 'radio',
            'class' => array( 'row-wide', 'update_totals_on_change', 'woocommerce-checkout__existing-client' ),
            'options' => array('Yes' => 'Yes', 'No' => 'No', 'Don&rsquo;t know' => 'Don&rsquo;t know', ),
            'label'  => __('Are you an existing BDO Audit client? (If you are unsure please select don&rsquo;t know and we will check for you)'),
            'required' => true
        ),
        $checkout->get_value('custom_existing_audit_client'));  

        woocommerce_form_field( 'custom_vat_number', array(
            'type' => 'text',
            'class' => array('row-wide', 'update_totals_on_change', 'woocommerce-checkout__custom-vat-number'),
            'label'  => __('VAT number'),
            'placeholder' => __('VAT number'),
            'required' => true
        ),
        $checkout->get_value('custom_vat_number'));

    }
    add_action( 'woocommerce_after_checkout_billing_form', 'custom_checkout_fields' );

    // 2a. Validate field messages
    function custom_field_validate() {
        if (!$_POST['custom_existing_audit_client']) { 
            wc_add_notice(__('Please let us know if you are an existing BDO Audit client') , 'error');
        }
        if (!$_POST['custom_vat_number']) { 
            wc_add_notice(__('Please enter your VAT number') , 'error'); 
        }
    }
    add_action('woocommerce_after_checkout_validation', 'custom_field_validate');

    // 2b. Radio button validation styling
    function custom_radio_validate(){
        // Only used on checkout page
        if( !is_checkout() ) return;
        ?>
        <script>
        jQuery(function($){
            $(document).ready(function () {
                // Add class on page load
                $('#custom_existing_audit_client_field').addClass('woocommerce-invalid');
                // Remove class on radio button change state
                $('#custom_existing_audit_client_field').find('input[type=radio]').change(function(){
                    $('#custom_existing_audit_client_field').removeClass('woocommerce-invalid');
                });
            });
        });
        </script>
        <?php
    }
    add_action( 'wp_footer', 'custom_radio_validate' );


    // 3. Save fields
    function custom_field_save( $order_id ) {
        if ( !empty( $_POST['custom_existing_audit_client'] ) ) {
            update_post_meta( $order_id, 'existing_customer', $_POST['custom_existing_audit_client']);
        }
        if ( !empty( $_POST['custom_vat_number'] ) ) {
            update_post_meta( $order_id, 'vat_number', $_POST['custom_vat_number']);
        }
    }
    add_action( 'woocommerce_checkout_update_order_meta', 'custom_field_save' );


// Display on order screen in admin
function custom_field_display_on_order_screen($order){
    
    $thecustomer = $order->get_user();
    $user_meta = get_user_meta($thecustomer->ID);
    if ( isset($user_meta['afreg_additional_4148'][0] ) ){
        $company = $user_meta['afreg_additional_4148'][0];
    } else {
        $company =  $user_meta['billing_company'][0];
    }
    echo "<p><strong>Company name:</strong><br />" . $company . "<p>";
    echo'<p><strong>BDO Audit client:</strong><br />' . get_post_meta( $order->ID, 'existing_customer', true );
    echo '</p>';
    echo'<p><strong>Vat number:</strong><br />' . get_post_meta( $order->ID, 'vat_number', true ) . '</p>';

    
}
add_action( 'woocommerce_admin_order_data_after_billing_address', 'custom_field_display_on_order_screen', 10, 1 );


// change checkbox message
function new_terms_and_conditions_checkbox_text( $text ){
    $termslink = get_field('terms_and_conditions_page_link', 'option');
    $text = 'I have read and agree to website <a href=" ' . $termslink . ' ">terms and conditions</a>';
    return $text;
}

add_filter( 'woocommerce_get_terms_and_conditions_checkbox_text', 'new_terms_and_conditions_checkbox_text' );


?>


