<?php
/**
 * Plugin Name: Post to Hero
 * Plugin URI: https://github.com/davidfcopozo/post-to-hero-plugin
 * Description: Transform any post into a stunning hero section with wavy animations and dynamic content. Includes CSS styles and shortcode support.
 * Version: 1.0.0
 * Author: David Francisco
 * Author URI: https://www.davidfrancisco.me/
 * License: GPL v2 or later
 * Text Domain: post-to-hero
 * Requires at least: 5.0
 * Tested up to: 6.4
 * Requires PHP: 7.4
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Include the main loader class
require_once plugin_dir_path(__FILE__) . 'includes/class-post-to-hero-loader.php';

/**
 * Main function to get PostToHero instance
 */
function PostToHero() {
    return PostToHeroLoader::instance();
}

// Initialize the plugin
PostToHero();