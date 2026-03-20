<?php

namespace SimpleWishlist;

class Cron
{
    /**
     * Register cron-related hooks
     */
    public function register()
    {
        // Register the cron event
        add_action('wishlist_nightly_email_cron', [$this, 'sendNightlyEmails']);

        // Register activation/deactivation hooks
        register_activation_hook(__FILE__, [$this, 'activateCron']);
        register_deactivation_hook(__FILE__, [$this, 'deactivateCron']);
    }

    /**
     * Schedule the cron job on plugin activation
     */
    public function activateCron()
    {
        if (!wp_next_scheduled('wishlist_nightly_email_cron')) {
            // Schedule the event to run at midnight
            wp_schedule_event(strtotime('today midnight'), 'daily', 'wishlist_nightly_email_cron');
        }
    }

    /**
     * Remove the cron job on plugin deactivation
     */
    public function deactivateCron()
    {
        $timestamp = wp_next_scheduled('wishlist_nightly_email_cron');
        if ($timestamp) {
            wp_unschedule_event($timestamp, 'wishlist_nightly_email_cron');
        }
    }

    /**
     * Send nightly emails to customers with wishlists
     */
    public function sendNightlyEmails()
    {
        $email = new Email();
        $sent_count = $email->sendWishlistReminders();

        // Log the result for debugging
        error_log(sprintf('Wishlist nightly emails sent: %d', $sent_count));
    }
}