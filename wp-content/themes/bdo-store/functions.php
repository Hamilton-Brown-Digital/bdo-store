<?php

/**
 * default functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wppt
 */
if (class_exists('Timber')) {

    /**
     * @desc Adding Timber functions
     */

    include 'functions/timber-functions.php';

    /**
     * @desc Initial set up of scripts and styles
     */

    include 'functions/setup/scripts.php';

    /**
     * @desc Adding robots function to allow sitemap.xml to work properly across multisite
     */

    include 'functions/setup/robots.php';

    /**
     * @desc Clean up WordPress extras
     */
    include 'functions/setup/restrictions.php';

    /**
     * @desc Setup image sizes
     */
    include 'functions/setup/images.php';

    /**
     * @desc Setup custom posts
     */
    include 'functions/setup/settings.php';

    /**
     * @desc ACF Fields Config - For Child Theming
     */

    include 'functions/setup/acf.php';

    /**
     * @desc Admin alterations
     */

    include 'functions/setup/admin_experience.php';

    /**
     * @desc Adding post support
     */

    include 'functions/setup/post_support.php';

    /**
     * @desc Change product categories to radios in backend
     */

    include 'functions/setup/product_categories.php';

    /**
     * @desc Adding registering of custom post types
     */

    include 'functions/register/custom-post-types.php';

    /**
     * @desc Adding registering of custom taxonomies
     */

    include 'functions/register/custom-taxonomies.php';

    /**
     * @desc Adding registering of menus
     */

    include 'functions/register/menus.php';

    /**
     * @desc Adding registering of options pages
     */

    include 'functions/register/options-pages.php';

    /**
     * @desc Adding woocommerce options
     */

    include 'functions/register/woocommerce.php';

}