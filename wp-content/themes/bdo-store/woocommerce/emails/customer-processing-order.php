<?php
/**
 * Customer processing order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-processing-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<?php
$custname = $order->get_billing_first_name();
?>

<div id="body_text">

<p>Dear <?php echo wp_kses_post($custname); ?>,</p>

<?php if ( $order->get_status() == 'on-hold' ) : ?>

	<?php echo get_field('email_on_hold', 'options'); ?>

<?php elseif ( $order->get_status() == 'processing' ) : ?>

	<?php echo get_field('email_processing', 'options'); ?>

<?php elseif ( $order->get_status() == 'passed-pending' ) : ?>

	<?php echo get_field('email_passed_pending', 'options'); ?>

<?php elseif ( $order->get_status() == 'failed' ) : ?>

	<?php echo get_field('email_failed', 'options'); ?>

<?php elseif ( $order->get_status() == 'failed-refund' ) : ?>

	<?php echo get_field('email_failed_refund', 'options'); ?>

<?php elseif ( $order->get_status() == 'passed-stripe' or  $order->get_status() == 'inv-payment-made' ) : ?>

	<?php if ($order->get_status() == 'passed-stripe') : ?>

		<?php echo get_field('email_passed_stripe', 'options'); ?><br>

	<?php elseif ($order->get_status() == 'inv-payment-made') : ?>

		<?php echo get_field('email_inv_payment_made', 'options'); ?><br>

	<?php endif; ?>

	<hr style="height:1px;background-color:#e5e5e5;border:none;margin-bottom:28px;">

	<?php foreach ( $order->get_items() as $item_id => $item ) :
		$product = $item->get_product();
		$productid = $product->get_id();
	?>
	<div class="product-access">
		<h3 class="product-access--title">
			<?php echo $product->get_title(); ?>
		</h3>

		<?php echo get_field('email_content', $productid); ?>

		<a target="_blank" class="btn btn-flat btn-accent" href="<?php echo get_permalink( get_field('gated_page', $productid) ); ?>">View product</a>
	</div>

<?php endforeach; ?>

<?php endif; ?>

</div><br>

<?php

/*
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @hooked WC_Structured_Data::generate_order_data() Generates structured data.
 * @hooked WC_Structured_Data::output_structured_data() Outputs structured data.
 * @since 2.5.0
 */
do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */
do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * Show user-defined additional content - this is set in each email's settings.
 */
if ( $additional_content ) {
	echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
}

/*
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );
