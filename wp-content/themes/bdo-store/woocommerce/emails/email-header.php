<?php
/**
 * Email Header
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-header.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates/Emails
 * @version 4.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
		<title><?php echo get_bloginfo( 'name', 'display' ); ?></title>
		<style type="text/css">
			@font-face {
				font-family: 'proximanovareg';
				font-style: normal;
				font-weight: normal;
				src: url('<?php echo get_site_url(); ?>/wp-content/themes/bdo-store/assets/src/fonts/proximanovareg.woff2') format('woff2'),
					url('<?php echo get_site_url(); ?>/wp-content/themes/bdo-store/assets/src/fonts/proximanovareg.woff') format('woff');
				}
			@font-face {
				font-family: 'proximanovabold';
				font-style: normal;
				font-weight: normal;
				src: url('<?php echo get_site_url(); ?>/wp-content/themes/bdo-store/assets/src/fonts/proximanovabold.woff2') format('woff2'),
					url('<?php echo get_site_url(); ?>/wp-content/themes/bdo-store/assets/src/fonts/proximanovabold.woff') format('woff');
			}
			body{
				font-family:'proximanovareg',sans-serif;
			}
			.wc-item-meta-label{
				float:none!important;
			}
		</style>
	</head>
	<body <?php echo is_rtl() ? 'rightmargin' : 'leftmargin'; ?>="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
		<div id="wrapper" style="padding-top:100px;background-color:#f7f7f7;" dir="<?php echo is_rtl() ? 'rtl' : 'ltr'; ?>">
			<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
				<tr>
					<td align="center" valign="top">
						<table border="0" cellpadding="0" cellspacing="0" width="650" id="template_container">
							<tr>
								<td align="center" valign="top">
									<!-- Header -->
									<table border="0" cellpadding="0" cellspacing="0" width="100%" id="template_header">
										<tr>
											<td id="header_wrapper" style="padding:32px 32px 0 32px">
											<div id="template_header_image">
												<img style="width:200px;height:auto;" src="<?php echo get_site_url(); ?>/wp-content/themes/bdo-store/assets/src/emails/bdo-logo.png" alt="BDO Store">
											</div>
											</td>
										</tr>
									</table>
									<!-- End Header -->
								</td>
							</tr>
						</table>
						<table border="0" cellpadding="0" cellspacing="0" width="650" id="template_container">
							<tr>
								<td align="center" valign="top">
									<!-- Body -->
									<table border="0" cellpadding="0" cellspacing="0" width="650" id="template_body">
										<tr>
											<td valign="top" id="body_content">
												<!-- Content -->
												<table border="0" cellpadding="20" cellspacing="0" width="100%">

												<tr>
													<td id="header_wrapper" style="padding:32px 32px 0 32px">
														<h1>BDO Store</h1>
														<h2><?php echo wp_kses_post( $email_heading ); ?></h2>
													</td>
												</tr>
													<tr>
														<td valign="top" style="padding:32px 32px 0 32px">
															<div id="body_content_inner">