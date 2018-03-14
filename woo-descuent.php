<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              dmanqn.com.ar
 * @since             1.0.0
 * @package           Woo_Descuent
 *
 * @wordpress-plugin
 * Plugin Name:       Woocommerce Add Descuent
 * Plugin URI:        www.dmanqn.com.ar
 * Description:       This is plugin create a field in the product admin area.
 * Version:           1.0.0
 * Author:            Bianqui Julián
 * Author URI:        dmanqn.com.ar
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woo-descuent
 * Domain Path:       /languages
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_NAME_VERSION', '0.0.1' );


require_once plugin_dir_path( __FILE__ ) . '/admin/class-woo-descuent-admin.php';
require_once plugin_dir_path( __FILE__ ) . '/include/class-descuent.php';
