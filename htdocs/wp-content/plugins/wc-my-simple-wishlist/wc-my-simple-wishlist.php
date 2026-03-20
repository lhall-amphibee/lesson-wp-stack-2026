<?php
/**
 * @package WPSimpleWishlist
 * @version 1.0.0
 */

/*
Plugin Name: WC Simple Wishlist
Plugin URI: http://amphibee.fr
Description: Add a product to your wishlist
Author: Loïc Hall
Version: 1.0.0
*/

require_once 'inc/Wishlist.php';
require_once 'inc/Cron.php';
require_once 'inc/Email.php';
require_once 'inc/Ajax.php';

(new \SimpleWishlist\Wishlist())->register();
(new \SimpleWishlist\Ajax())->register();
(new \SimpleWishlist\Cron())->register();

(new \SimpleWishlist\Cron())->activateCron();