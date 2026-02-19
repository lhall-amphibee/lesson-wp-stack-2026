<?php

/**
 * Plugin Name:       MU Loader
 * Plugin URI:        https://amphibee.fr
 * Description:       Loader file for MU plugins
 * Version:          1.0.0
 * Requires PHP:      7.4
 * Requires at least: 5.8
 * Author:           Loïc Hall
 * Author URI:       https://amphibee.fr
 * License:          GPL v2 or later
 * License URI:      https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package EventsManager
 */

require_once 'acf-codifier/plugin.php';


$mu_plugins_dir = __DIR__ . '/mu-plugins';

if (is_dir($mu_plugins_dir)) {
    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($mu_plugins_dir)) as $fileInfo) {
        if ($fileInfo->isFile() && $fileInfo->getExtension() === 'php') {
            require_once $fileInfo->getPathname();
        }
    }
}
