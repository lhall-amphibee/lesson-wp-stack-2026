<?php
$wishlist = get_user_meta(get_current_user_id(), 'wishlist', 'single') ?? [];
$in_wishlist = false;
if (is_array($wishlist)) {
    $in_wishlist = in_array((int) get_the_ID(), $wishlist, true);
}

?>
<a
    class="wishlist-add-product" href="#"
    data-productid="<?php echo get_the_ID(); ?>"
    data-nonce="<?php echo wp_create_nonce('wishlist-toggle'); ?>"
    data-action="wishlist-add"
>
    <img src="<?php echo home_url('wp-content/plugins/wc-my-simple-wishlist/public/assets/img/heart'. ($in_wishlist ? '-active' : '') .'.png') ?>" alt="Not in wishlist" height="60px" >
</a>
