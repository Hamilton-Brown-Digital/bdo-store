<?php

// register a custom post status for Orders
add_action( 'init', 'register_custom_post_status', 20 );
function register_custom_post_status() {
    register_post_status( 'wc-passed-pending', array(
        'label'                     => _x( 'Invoice payment, CC passed', 'Order status', 'woocommerce' ),
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Invoice payment, CC passed <span class="count">(%s)</span>', 'Invoice payment, CC passed <span class="count">(%s)</span>', 'woocommerce' )
    ) );

    register_post_status( 'wc-failed', array(
        'label'                     => _x( 'Invoice payment, CC failed', 'Order status', 'woocommerce' ),
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Invoice payment, CC failed <span class="count">(%s)</span>', 'Invoice payment, CC failed <span class="count">(%s)</span>', 'woocommerce' )
    ) );

    register_post_status( 'wc-failed-refund', array(
        'label'                     => _x( 'Stripe payment made, CC failed', 'Order status', 'woocommerce' ),
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Stripe payment made, CC failed <span class="count">(%s)</span>', 'Stripe payment made, CC failed <span class="count">(%s)</span>', 'woocommerce' )
    ) );

    register_post_status( 'wc-passed-stripe', array(
        'label'                     => _x( 'Stripe payment made, CC passed', 'Order status', 'woocommerce' ),
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Stripe payment made, CC passed <span class="count">(%s)</span>', 'Stripe payment made, CC passed <span class="count">(%s)</span>', 'woocommerce' )
    ) );

    register_post_status( 'wc-inv-payment-made', array(
        'label'                     => _x( 'Invoice payment made', 'Order status', 'woocommerce' ),
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Invoice payment made <span class="count">(%s)</span>', 'Invoice payment made <span class="count">(%s)</span>', 'woocommerce' )
    ) );
}

// Adding custom status to order edit pages dropdown
add_filter( 'wc_order_statuses', 'custom_wc_order_statuses' );
function custom_wc_order_statuses( $order_statuses ) {
    $new_order_statuses = array();

    foreach ( $order_statuses as $key => $status ) {
        $new_order_statuses[ $key ] = $status;
 
        if ( 'wc-processing' === $key ) {
            $new_order_statuses['wc-passed-pending'] = _x( 'Invoice payment, CC passed', 'Order status', 'woocommerce' );
            $new_order_statuses['wc-failed'] = _x( 'Invoice payment, CC failed', 'Order status', 'woocommerce' );
            $new_order_statuses['wc-failed-refund'] = _x( 'Stripe payment made, CC failed', 'Order status', 'woocommerce' );
            $new_order_statuses['wc-passed-stripe'] = _x( 'Stripe payment made, CC passed', 'Order status', 'woocommerce' );
            $new_order_statuses['wc-inv-payment-made'] = _x( 'Invoice payment made', 'Order status', 'woocommerce' );
        }

        if ( 'wc-pending' === $key ) {
            $new_order_statuses['wc-pending'] = _x( 'Pending order', 'Order status', 'woocommerce' );
        }

        if ( 'wc-on-hold' === $key ) {
            $new_order_statuses['wc-on-hold'] = _x( 'Invoice payment, Pending CC', 'Order status', 'woocommerce' );
        }

        if ( 'wc-processing' === $key ) {
            $new_order_statuses['wc-processing'] = _x( 'Stripe payment made, Pending CC', 'Order status', 'woocommerce' );
        }

        if ( 'wc-completed' === $key ) {
            $new_order_statuses['wc-completed'] = _x( 'Order fulfilled', 'Order status', 'woocommerce' );
        }

        if ( 'wc-cancelled' === $key ) {
            $new_order_statuses['wc-cancelled'] = _x( 'Order cancelled', 'Order status', 'woocommerce' );
        }
    }

    return $new_order_statuses;
}

// Adding custom status to admin order list bulk dropdown
add_filter( 'bulk_actions-edit-shop_order', 'custom_dropdown_bulk_actions_shop_order', 20, 1 );
function custom_dropdown_bulk_actions_shop_order( $actions ) {
    $actions['wc-passed-pending'] = __( 'Invoice payment, CC passed', 'woocommerce' );
    $actions['wc-failed'] = __( 'Invoice payment, CC failed', 'woocommerce' );
    $actions['wc-failed-refund'] = __( 'Stripe payment made, CC failed', 'woocommerce' );
    $actions['wc-passed-stripe'] = __( 'Stripe payment made, CC passed', 'woocommerce' );
    $actions['wc-inv-payment-made'] = __( 'Invoice payment made', 'woocommerce' );

    $actions['wc-pending'] = __( 'Pending order', 'woocommerce' );
    $actions['wc-on-hold'] = __( 'Invoice payment, Pending CC', 'woocommerce' );
    $actions['wc-processing'] = __( 'Stripe payment made, Pending CC', 'woocommerce' );
    $actions['wc-completed'] = __( 'Order fulfilled', 'woocommerce' );
    $actions['wc-cancelled'] = __( 'Order cancelled', 'woocommerce' );
    return $actions;
}

add_action('woocommerce_order_status_on-hold', 'order_status_email_notification', 20, 2);
add_action('woocommerce_order_status_processing', 'order_status_email_notification', 20, 2);
add_action('woocommerce_order_status_passed-pending', 'order_status_email_notification', 20, 2);
add_action('woocommerce_order_status_failed', 'order_status_email_notification', 20, 2);
add_action('woocommerce_order_status_failed-refund', 'order_status_email_notification', 20, 2);
add_action('woocommerce_order_status_passed-stripe', 'order_status_email_notification', 20, 2);
add_action('woocommerce_order_status_inv-payment-made', 'order_status_email_notification', 20, 2);
function order_status_email_notification ( $order_id, $order ) {    
        $email_key   = 'WC_Email_Customer_Processing_Order';
        $email_obj = WC()->mailer()->get_emails()[$email_key];
        $email_obj->trigger( $order_id );
}

$subject_on_hold = get_field('email_on_hold', 'options')['email_on_hold_subject'];
$subject_processing = get_field('email_processing', 'options')['email_processing_subject'];
$subject_passed_pending = get_field('email_passed_pending', 'options')['email_passed_pending_subject'];
$subject_failed = get_field('email_failed', 'options')['email_failed_subject'];
$subject_failed_refund = get_field('email_failed_refund', 'options')['email_failed_refund_subject'];
$subject_passed_stripe = get_field('email_passed_stripe', 'options')['email_passed_stripe_subject'];
$subject_invoice_payment_made = get_field('email_inv_payment_made', 'options')['email_inv_payment_made_subject'];

add_filter( 'woocommerce_email_subject_customer_processing_order', 'email_subject_passed_pending', 10, 2 );
function email_subject_passed_pending ( $subject, $order ) {
    // 1. Pending / Conflict check, purchase not made yet (invoice)
    if( $order->has_status( 'on-hold' ) ) {
        $subject = __('Thank you for your order at BDO Store – Your order is pending', 'woocommerce');
    }
    // 2. Pending / Conflict check, purchase made (stripe)
    if( $order->has_status( 'processing' ) ) {
        $subject = __('Thank you for your order at BDO Store – Your order is pending', 'woocommerce');
    }
    // 3. Cleared, confirmation & notification of BDO invoice (invoice)
    if( $order->has_status( 'passed-pending' ) ) {
        $subject = __('BDO Store – No conflicts found', 'woocommerce');
    }
    // 4. Conflict of interest found no further action needed (invoice)
    if( $order->has_status( 'failed' ) ) {
        $subject = __('BDO Store – Conflict of interest found', 'woocommerce');
    }
    // 5. Conflict of interest found We will process refund (stripe)
    if( $order->has_status( 'failed-refund' ) ) {
        $subject = __('BDO Store – conflict of interest found', 'woocommerce');
    }
    // 6. Conflict of interest cleared, confirmation & notification of BDO invoice (stripe)
    if( $order->has_status( 'passed-stripe' ) ) {
        $subject = __('BDO Store – Your order is confirmed', 'woocommerce');
    }
    // 7. Thankyou for your payment (invoice)
    if( $order->has_status( 'inv-payment-made' ) ) {
        $subject = __('BDO Store – Thank you for your payment', 'woocommerce');
    }
    return $subject;
}


// renaming statuses to more customer-friendly on the front-end

function statusrename($status){
    $customerstatus = 'Processing';
    if($status == 'completed'){
        $customerstatus = 'Completed';
    } elseif($status == 'refunded') {
        $customerstatus = 'Refunded';
    } elseif($status == 'cancelled') {
        $customerstatus = 'Cancelled';
    } elseif($status == 'failed') {
        $customerstatus = 'Failed';
    }
    return $customerstatus;
}