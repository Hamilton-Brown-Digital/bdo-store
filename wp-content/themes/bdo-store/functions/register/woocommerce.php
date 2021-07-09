<?php

    // Register Woo
    add_action( 'after_setup_theme', 'theme_add_woocommerce_support' );    
    function theme_add_woocommerce_support() {
        add_theme_support( 'woocommerce' );
    }

    include 'woocommerce/product.php';

    include 'woocommerce/account.php';

    include 'woocommerce/login-register.php';

    include 'woocommerce/status.php';

    include 'woocommerce/cart.php';