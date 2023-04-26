<?php
/**
 * Plugin Name: WP Custom Dashboard
 * Plugin URI: http://wordpress.org/plugins
 * Description: WP plugin to add a Dashboard Widget using recharts.org
 * Version: 1.0.0
 * Author: Prakash Rao
 * Author URI: https://wordpresscapital.com
 * Text Domain: rankmath-inspector
 * Domain Path: /languages
 * License: GPLv3
 */

define( 'CUSTOM_DASH_VERSION', '1.0' );
define( 'CUSTOM_DASH_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'CUSTOM_DASH_PLUGIN_URI', plugin_dir_url( __FILE__ ) );


// including the init file
require_once CUSTOM_DASH_PLUGIN_PATH . '/includes/init.php';