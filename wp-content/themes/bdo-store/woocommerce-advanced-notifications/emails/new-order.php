<?php
/**
 * New order email
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// allowed tags for escaping
$allowed_tags = array(
	'span' => array(),
	'div'  => array(),
	'p'    => array(),
);

$text_align = is_rtl() ? 'right' : 'left';
?>

<p><?php printf( __( 'Hi %s,', 'woocommerce-advanced-notifications' ), esc_html( $recipient_name ) ); ?></p>

<p><?php
/* translators: 1: first name 2: last name */
printf( __( 'You have received an order from %s %s:', 'woocommerce-advanced-notifications' ), version_compare( WC_VERSION, '3.0.0', '<' ) ? $order->billing_first_name : $order->get_billing_first_name(), version_compare( WC_VERSION, '3.0.0', '<' ) ? $order->billing_last_name : $order->get_billing_last_name() );
?></p>

<h2><a class="link" href="<?php echo admin_url( 'post.php?post=' . ( version_compare( WC_VERSION, '3.0.0', '<' ) ? $order->id : $order->get_id() ) . '&action=edit' ); ?>"><?php printf( __( 'Order #%s', 'woocommerce-advanced-notifications' ), $order->get_order_number() ); ?></a> (<?php printf( '<time datetime="%s">%s</time>', date_i18n( 'c', strtotime( version_compare( WC_VERSION, '3.0.0', '<' ) ? $order->order_date : $order->get_date_created() ) ), date_i18n( wc_date_format(), strtotime( version_compare( WC_VERSION, '3.0.0', '<' ) ? $order->order_date : $order->get_date_created() ) ) ); ?>)</h2>


<?php
if ( 'bacs' !== ( version_compare( WC_VERSION, '3.0.0', '<' ) ? $order->payment_method : $order->get_payment_method() ) || apply_filters( 'woocommerce_advanced_notifications_show_bacs_info', false ) ) {
	do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, false, $email );
}
?>

<table class="td" cellspacing="0" cellpadding="6" style="width: 100%; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;" border="1">
	<thead>
		<tr>
			<th class="td" scope="col" style="text-align:left;"><?php esc_html_e( 'Product', 'woocommerce-advanced-notifications' ); ?></th>
			<th class="td" scope="col" style="text-align:left;" <?php if ( ! $show_prices ) : ?>colspan="2"<?php endif; ?>><?php esc_html_e( 'Quantity', 'woocommerce-advanced-notifications' ); ?></th>
			<?php if ( $show_prices ) : ?>
				<th class="td" scope="col" style="text-align:left;"><?php _e( 'Price', 'woocommerce-advanced-notifications' ); ?></th>
			<?php endif; ?>
		</tr>
	</thead>

	<tbody>
		<?php
		$displayed_total = 0;

		foreach ( $order->get_items() as $item_id => $item ) :

			if ( is_callable( array( $item, 'get_product' ) ) ) {
				$_product = $item->get_product();
			} else {
				$_product = $order->get_product_from_item( $item );
			}

			$display = false;

			$product_id = $_product->is_type( 'variation' ) && version_compare( WC_VERSION, '3.0', '>=' ) ? $_product->get_parent_id() : $_product->get_id();

			if ( $triggers['all'] || in_array( $product_id, $triggers['product_ids'] ) || in_array( $_product->get_shipping_class_id(), $triggers['shipping_classes'] ) ) {
				$display = true;
			}

			if ( ! $display ) {

				$cats = wp_get_post_terms( $product_id, 'product_cat', array( 'fields' => 'ids' ) );

				if ( sizeof( array_intersect( $cats, $triggers['product_cats'] ) ) > 0 )
					$display = true;

			}

			if ( ! $display )
				continue;

			$displayed_total += $order->get_line_total( $item, true );

			$item_meta = version_compare( WC_VERSION, '3.0', '<' ) ? new WC_Order_Item_Meta( $item ) : new WC_Order_Item_Product( $item_id );
			?>
			<tr>
				<td class="td" style="text-align:left; vertical-align:middle; border: 1px solid #eee; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; word-wrap:break-word;"><?php

					// Product name
					echo apply_filters( 'woocommerce_order_product_title', $item['name'], $_product );

					// SKU
					echo $_product->get_sku() ? ' (#' . $_product->get_sku() . ')' : '';

					// allow other plugins to add additional product information here
					do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order, $plain_text );

					// Variation
					if ( version_compare( WC_VERSION, '3.0', '<' ) ) {
						echo $item_meta->meta ? '<br/><small>' . nl2br( $item_meta->display( true, true ) ) . '</small>' : '';
					} else {
						wc_display_item_meta( $item );
					}

					// File URLs
					if ( $show_download_links ) {
						version_compare( WC_VERSION, '3.0.0', '<' ) ? $order->display_item_downloads( $item ) : wc_display_item_downloads( $item );
					}

					// allow other plugins to add additional product information here
					do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order, $plain_text );
				?></td>
				<td class="td" style="text-align:left; vertical-align:middle; border: 1px solid #eee; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;" <?php if ( ! $show_prices ) : ?>colspan="2"<?php endif; ?>><?php echo esc_html( $item['qty'] ) ;?></td>

				<?php if ( $show_prices ) : ?>
					<td style="text-align:left; vertical-align:middle; border: 1px solid #eee; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;"><?php echo wp_kses( $order->get_formatted_line_subtotal( $item ), $allowed_tags ); ?></td>
				<?php endif; ?>
			</tr>

		<?php endforeach; ?>
	</tbody>

	<tfoot>
		<?php
		if ( $show_totals ) :
			if ( $triggers['all'] && ( $totals = $order->get_order_item_totals() ) ) {
				$i = 0;
				foreach ( $totals as $total ) {
					$i++;
					?><tr>
						<th class="td" scope="col" colspan="2" style="font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; text-align:left;"><?php echo esc_html( $total['label'] ); ?></th>
						<td style="text-align:left;border: 1px solid #eee;"><?php echo wp_kses( $total['value'], $allowed_tags ); ?></td>
					</tr><?php
				}
			} else {
				// Only show the total for displayed items
				?>
				<tr>
					<th class="td" scope="col" colspan="2" style="font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; text-align:left;"><?php _e( 'Total', 'woocommerce-advanced-notifications' ); ?></th>
					<td style="text-align:left;border: 1px solid #eee;"><?php echo wp_kses( wc_price( $displayed_total ), $allowed_tags ); ?></td>
				</tr>
				<?php
			}
		endif;

		if ( $order->get_customer_note() ) {
			?><tr>
				<th class="td" scope="row" colspan="2" style="text-align:<?php echo $text_align; ?>;"><?php _e( 'Note:', 'woocommerce-advanced-notifications' ); ?></th>
				<td class="td" style="text-align:<?php echo $text_align; ?>;"><?php echo wptexturize( $order->get_customer_note() ); ?></td>
			</tr><?php
		}
		?>
	</tfoot>
</table>

<?php do_action( 'woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text, $email ); ?>

<?php do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email ); ?>

<?php
/**
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */


$thecustomer = $order->get_user();
$user_meta = get_user_meta($thecustomer->ID);

if ( isset($user_meta['afreg_additional_4148'][0] ) ){
	$company = $user_meta['afreg_additional_4148'][0];
} else {
	$company =  $user_meta['billing_company'][0];
}
$email_address = get_post_meta($order->get_order_number(), '_billing_email', true);
$vat_number = get_post_meta($order->get_order_number(), 'vat_number', true);
$declaration = get_post_meta($order->get_order_number(), 'existing_customer', true);
$custname = $user_meta['first_name'][0] . ' ' . $user_meta['last_name'][0];
$billing_address_1 = $user_meta['billing_address_1'][0];
$billing_address_2 = $user_meta['billing_address_2'][0];
$billing_city = $user_meta['billing_city'][0];
$billing_postcode = $user_meta['billing_postcode'][0];
$billing_country = $user_meta['billing_country'][0];
$ordermethod = $order->get_payment_method_title();

echo "\n\n\n\n";


echo "BILLING ADDRESS";

echo "\n\n";

echo "Shopper's Name: " . $custname . "\n";
echo "Shopper's Address: " . $billing_address_1 . "\n";
echo $billing_address_2 . "\n";
echo $billing_city . "\n";
echo "Shopper's Postcode: " . $billing_postcode . "\n";
echo "Shopper's Country: " . $billing_country . "\n";
echo "VAT Number: " . $vat_number . "\n";
echo "Shopper's Email: " . $email_address . "\n";
echo "Payment method: " . $ordermethod;

echo "\n\n";

echo "ORDER METADATA";

echo "\n\n";

echo "Email address:" . " " . $email_address . "\n";
echo "Company name:" . " " . $company . "\n";
echo "VAT number:" . " " . $vat_number . "\n";
echo "Non audit client declaration:" . " " . $declaration;

echo "\n\n";

echo "The above payment has been processed.";