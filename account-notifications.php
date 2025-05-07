<?php
/**
 * Plugin Name: Account Notification Handler
 * Description: Automates UM registration flows & emails based on account type.
 * Version:     2.1.0
 * Author:      Keron Lewis <keronlewis@live.com>
 * Text Domain: account-notifications
 * Domain Path: /languages
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Define paths
define( 'ANH_PATH', plugin_dir_path( __FILE__ ) );

// Load dependencies
require ANH_PATH . 'includes/class-anh-helpers.php';
require ANH_PATH . 'includes/class-anh-settings.php';
require ANH_PATH . 'includes/class-anh-registration.php';

// Initialize admin page
add_action( 'admin_menu', [ 'ANH_Settings', 'add_settings_page' ] );
add_action( 'admin_init', [ 'ANH_Settings', 'register_settings' ] );
add_action( 'admin_enqueue_scripts', [ 'ANH_Settings', 'enqueue_scripts' ] );

// Hook registration
add_action( 'um_registration_complete', [ 'ANH_Registration', 'process_registration' ], 20, 2 );
