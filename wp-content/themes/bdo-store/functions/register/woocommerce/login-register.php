<?php

// REGISTER FORM
add_shortcode( 'wc_reg_form', 'woo_separate_registration_form' );
function woo_separate_registration_form() {
    if ( is_admin() ) {
        header('Location: /');
    }

    if ( is_user_logged_in() ) {
        header('Location: /account/welcome');
    }
    ob_start();

    
    ?>

    <div class="login-register">

        <div class="customer-login__tabs">
            <a href="/account" class="customer-login__tab"><?php esc_html_e( 'Login', 'woocommerce' ); ?></a>
            <a href="/register" class="customer-login__tab  customer-login__tab--active"><?php esc_html_e( 'Register', 'woocommerce' ); ?></a>
        </div>

        <div class="customer-login__content customer-login__content--register">

            <form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

                <?php do_action( 'woocommerce_before_customer_login_form' ); ?>
                <?php do_action( 'woocommerce_register_form_start' ); ?>

                <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                    </p>

                <?php endif; ?>

                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                    <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                </p>

                <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                        <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
                    </p>

                <?php else : ?>

                    <p><?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></p>

                <?php endif; ?>

                <?php do_action( 'woocommerce_register_form' ); ?>

                <p class="woocommerce-form-row form-row">
                    <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                    <button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
                </p>

                <?php do_action( 'woocommerce_register_form_end' ); ?>

            </form>

        </div>

    </div>

    <?php
    return ob_get_clean();
}

// Add company to register page
function woo_register_new_fields() {
    ?>
    <p class="form-row form-row-full">
        <label for="billing_company"><?php _e('Company name', 'woocommerce'); ?><span class="required">*</span></label>
        <input type="text" class="input-text" name="billing_company" id="billing_company" value="<?php if (!empty($_POST['billing_company'])) esc_attr_e($_POST['billing_company']); ?>" />
    </p>
    <?php
}    
add_action('woocommerce_register_form', 'woo_register_new_fields');

// Validate comoany on register page
function woo_register_new_fields_validate($username, $email, $validation_errors) {
    if (isset($_POST['billing_company']) && empty($_POST['billing_company'])) {
        $validation_errors->add('billing_company_error', __('<strong>Error</strong>: Company name is required!', 'text_domain'));
    }
    return $validation_errors;
}    
add_action('woocommerce_register_post', 'woo_register_new_fields_validate', 10, 3);

// Save comapany on register page
function woo_register_new_fields_save($customer_id) {
    if (isset($_POST['billing_company'])) {
        update_user_meta($customer_id, 'billing_company', sanitize_text_field($_POST['billing_company']));
        update_user_meta($customer_id, 'shipping_company', sanitize_text_field($_POST['billing_company']));
    }
}    
add_action('woocommerce_created_customer', 'woo_register_new_fields_save');