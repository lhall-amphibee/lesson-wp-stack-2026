<?php
/**
 * This file is part of the AmphiBee package.
 * (c) AmphiBee <contact@amhibee.fr>
 */


namespace SimpleWishlist;

class Ajax
{
    public function register()
    {
        add_action( 'wp_ajax_simple_wishlist_toggle', [$this, 'simple_wishlist_toggle'] );
        add_action( 'wp_ajax_nopriv_simple_wishlist_toggle', [$this, 'simple_wishlist_toggle'] );
    }
    
    public function simple_wishlist_toggle()
    {
        if(
            ! isset( $_REQUEST['nonce'] ) or
            ! wp_verify_nonce( $_REQUEST['nonce'], 'wishlist-toggle' ) or 
            ! get_current_user_id()
        ) {
            wp_send_json_error( "Error while performing this action", 403 );
        }

        $wishlist = get_user_meta(get_current_user_id(), 'wishlist', 'single') ?? [];
        
        if (!is_array($wishlist)) {
            $wishlist = [];
        }

        $product_id = $_POST['productid'];

        if (in_array($product_id, $wishlist)) {
            $key = array_search($product_id, $wishlist);
            if ($key !== false) {
                unset($wishlist[$key]);
            }
        } else {
            $wishlist[] = (int)$product_id;
        }
        
        update_user_meta(get_current_user_id(), 'wishlist', $wishlist);

        $in_wishlist = in_array((int) $product_id, $wishlist, true);
        $icon = home_url('wp-content/plugins/wc-my-simple-wishlist/public/assets/img/heart.png');
        if ($in_wishlist) {
            $icon = home_url('wp-content/plugins/wc-my-simple-wishlist/public/assets/img/heart-active.png');
        }

        $result = [
            'success' => true,
            'in_wishlist' => $in_wishlist,
            'message' => 'Added to wishlist',
            'icon' => $icon
        ];
        
        wp_send_json_success( $result );
    }
}
