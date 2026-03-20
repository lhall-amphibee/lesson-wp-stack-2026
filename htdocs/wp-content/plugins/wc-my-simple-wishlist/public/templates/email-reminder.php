<?php
/**
 * Email template for wishlist reminders
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

$user = get_user_by('id', $user_id);
$wishlist_items = [];

foreach ($wishlist as $product_id) {
    $product = wc_get_product($product_id);
    if ($product) {
        $wishlist_items[] = [
            'id' => $product_id,
            'name' => $product->get_name(),
            'price' => $product->get_price_html(),
            'url' => get_permalink($product_id),
            'image' => wp_get_attachment_image_url($product->get_image_id(), 'thumbnail')
        ];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo esc_html(get_bloginfo('name')); ?> - Your Wishlist</title>
</head>
<body style="background-color: #f7f7f7; padding: 20px; font-family: Arial, sans-serif;">
<div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 5px;">
    <h1 style="color: #333333;">Your Wishlist at <?php echo esc_html(get_bloginfo('name')); ?></h1>

    <p>Hello <?php echo esc_html($user->display_name); ?>,</p>

    <p>Here's a reminder of the items in your wishlist:</p>

    <div style="margin: 20px 0;">
        <?php foreach ($wishlist_items as $item): ?>
            <div style="margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid #eeeeee;">
                <div style="display: flex; align-items: center;">
                    <?php if ($item['image']): ?>
                        <div style="margin-right: 15px;">
                            <img src="<?php echo esc_url($item['image']); ?>" alt="<?php echo esc_attr($item['name']); ?>" style="width: 80px; height: auto;">
                        </div>
                    <?php endif; ?>

                    <div>
                        <h3 style="margin: 0 0 10px 0;"><?php echo esc_html($item['name']); ?></h3>
                        <p style="margin: 0 0 10px 0;"><?php echo $item['price']; ?></p>
                        <a href="<?php echo esc_url($item['url']); ?>" style="background-color: #0066cc; color: #ffffff; padding: 8px 15px; text-decoration: none; border-radius: 3px; display: inline-block;">View Product</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <p>Thank you for shopping with us!</p>

    <p>Best regards,<br>
        <?php echo esc_html(get_bloginfo('name')); ?> Team</p>
</div>
</body>
</html>
