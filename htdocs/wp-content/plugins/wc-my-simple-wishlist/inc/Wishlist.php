<?php
/**
 * This file is part of the AmphiBee package.
 * (c) AmphiBee <contact@amhibee.fr>
 */


namespace SimpleWishlist;

class Wishlist
{
    public function register()
    {
        add_action('woocommerce_after_add_to_cart_button', function () {
            if (is_user_logged_in()) {
                include __DIR__ . '/../public/templates/button.php';
            }
        });
        
        add_action('wp_enqueue_scripts', function () {
            wp_enqueue_script(
                'simple-wishlist',
                home_url('wp-content/plugins/wc-my-simple-wishlist/public/assets/js/simple-wishlist.js'), [],
                '1.0',
                true
            );
            
            wp_enqueue_style(
                'simple-wishlist',
                home_url('wp-content/plugins/wc-my-simple-wishlist/public/assets/css/simple-wishlist.css'), [],
                '1.0',                
            );
        });
    }
}
