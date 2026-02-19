<?php

/**
 * Plugin Name:       Events Manager
 * Plugin URI:        https://amphibee.fr
 * Description:       Manage your events.
 * Version:          1.0.0
 * Requires PHP:      7.4
 * Requires at least: 5.8
 * Author:           Loïc Hall
 * Author URI:       https://amphibee.fr
 * License:          GPL v2 or later
 * License URI:      https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:      events-manager
 * Domain Path:      /languages
 *
 * @package EventsManager
 */

use EventsManager\Metaboxes;
use EventsManager\PostType;
use EventsManager\Taxonomies;


// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}


require_once 'inc/Metaboxes.php';
require_once 'inc/PostType.php';
require_once 'inc/Taxonomies.php';

(new Metaboxes())->register();
(new PostType())->register();
(new Taxonomies())->register();

