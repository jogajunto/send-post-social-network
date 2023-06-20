<?php
/**
 * Plugin Name: Send Posts in Social Network with Zapier
 * Description: Plugin for send to posts in zapier endpoint
 * Version: 1.0.0
 * Author: Rafael de Araujo Procopio
 * Author URI: https://github.com/rafaell1995
 * Text Domain: send-post-social-network
 * License: GPL-2.0-or-later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

// Se esse arquivo é chamado diretamente, abortar.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Carrega o autoload do Composer.
require __DIR__ . '/vendor/autoload.php';

function define_constants()
{
    // Define globals constants of plugin
    define( 'SEND_POST_SOCIAL_NETWORK_PATH', plugin_dir_path( __FILE__ ) );
    define( 'SEND_POST_SOCIAL_NETWORK_URL', plugin_dir_url( __FILE__ ) );
    define( 'SEND_POST_SOCIAL_NETWORK_VERSION', '1.0.0' );
}

// Inicia o plugin.
function runSendPostSocialNetwork() {
    register_activation_hook( __FILE__, array( 'SendPostSocialNetwork\SendPostInit', 'activate' ) );
    register_deactivation_hook( __FILE__, array( 'SendPostSocialNetwork\SendPostInit', 'deactivate' ) );
    register_uninstall_hook( __FILE__, array( 'SendPostSocialNetwork\SendPostInit', 'uninstall' ) );

    $plugin = SendPostSocialNetwork\SendPostInit::getInstance();
    $plugin->initPlugin();
}

define_constants();
runSendPostSocialNetwork();
