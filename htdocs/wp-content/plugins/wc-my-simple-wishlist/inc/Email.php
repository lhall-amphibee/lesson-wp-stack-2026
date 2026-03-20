<?php

namespace SimpleWishlist;

class Email
{
    /**
     * Send wishlist reminder email to a user
     *
     * @param int $user_id User ID to send email to
     * @return bool Whether the email was sent successfully
     */
    public function sendWishlistReminder($user_id)
    {
        $user = get_user_by('id', $user_id);
        if (!$user) {
            return false;
        }

        $wishlist = get_user_meta($user_id, 'wishlist', true) ?: [];
        if (empty($wishlist)) {
            return false;
        }

        $subject = sprintf(__('Your WooCommerce Wishlist - %s', 'wc-my-simple-wishlist'), get_bloginfo('name'));
        $headers = ['Content-Type: text/html; charset=UTF-8'];

        ob_start();
        include __DIR__ . '/../public/templates/email-reminder.php';
        $message = ob_get_clean();

        return wp_mail($user->user_email, $subject, $message, $headers);
    }

    /**
     * Send wishlist reminders to all users with wishlists
     *
     * @return int Number of emails sent
     */
    public function sendWishlistReminders()
    {
        global $wpdb;

        // Get all users with non-empty wishlists
        $users = $wpdb->get_col(
            "SELECT user_id FROM {$wpdb->usermeta} 
            WHERE meta_key = 'wishlist' 
            AND meta_value != ''"
        );

        $sent_count = 0;
        foreach ($users as $user_id) {
            if ($this->sendWishlistReminder($user_id)) {
                $sent_count++;
            }
        }

        return $sent_count;
    }
}