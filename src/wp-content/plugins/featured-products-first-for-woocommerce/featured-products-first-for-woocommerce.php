<?php

/**
 * Plugin Name: Featured Products First for WooCommerce
 * Plugin URI: https://profiles.wordpress.org/pmbaldha/
 * Description: Enables featured products listed first On Shop Page, Category Archive Page and Search Page
 * Version: 1.8
 * Author: Prashant Baldha
 * Author URI: hhttps://profiles.wordpress.org/pmbaldha/#content-plugins
 * Requires at least: 3.8
 * Tested up to: 5.1
 *
 * Text Domain: featured-products-first-for-woocommerce
 * Domain Path: /languages/
 * WC requires at least: 3.4.5
 * WC tested up to: 3.5.5
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

if ( !function_exists( 'wff' ) ) {
    // Create a helper function for easy SDK access.
    function wff()
    {
        global  $wff ;
        
        if ( !isset( $wff ) ) {
            // Activate multisite network integration.
            if ( !defined( 'WP_FS__PRODUCT_1689_MULTISITE' ) ) {
                define( 'WP_FS__PRODUCT_1689_MULTISITE', true );
            }
            // Include Freemius SDK.
            require_once __DIR__ . '/freemius/start.php';
            $wff = fs_dynamic_init( array(
                'id'              => '1689',
                'slug'            => 'featured-products-first-for-woocommerce',
                'type'            => 'plugin',
                'public_key'      => 'pk_fcce2e3f8c351f2e0dcdc012ba146',
                'is_premium'      => false,
                'has_addons'      => false,
                'has_paid_plans'  => true,
                'trial'           => array(
                'days'               => 7,
                'is_require_payment' => false,
            ),
                'has_affiliation' => 'selected',
                'menu'            => array(
                'slug'       => 'featured-products-first-for-woocommerce',
                'first-path' => 'admin.php?page=featured-products-first-for-woocommerce',
            ),
                'is_live'         => true,
            ) );
        }
        
        return $wff;
    }
    
    // Init Freemius.
    wff();
    // Signal that SDK was initiated.
    do_action( 'wff_loaded' );
    wff()->add_filter( 'handle_gdpr_admin_notice', '__return_true' );
    if ( !defined( 'WFF__FILE__' ) ) {
        define( 'WFF__FILE__', __FILE__ );
    }
    if ( !defined( 'WFF_DIR' ) ) {
        define( 'WFF_DIR', dirname( WFF__FILE__ ) );
    }
    require_once WFF_DIR . '/includes/helper.php';
    /**
     * Check if WooCommerce is active
     */
    if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        // return;
    }
    require_once WFF_DIR . '/includes/class-wff.php';
    if ( is_admin() ) {
        require_once WFF_DIR . '/includes/class-wff-admin.php';
    }
}
