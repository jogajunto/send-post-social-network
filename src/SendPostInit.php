<?php

namespace SendPostSocialNetwork;

use SendPostSocialNetwork\SendPostSettings;
use SendPostSocialNetwork\SendPostHooks;

class SendPostInit {
    /**
     * Versão do Plugin.
     */
    const VERSION = '1.0.0';

    /**
     * Instância única desta classe.
     */
    protected static $instance = null;

    /**
     * Retorna uma instância única desta classe.
     */
    public static function getInstance() {
        if ( null == self::$instance ) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * Inicializa o plugin.
     */
    private function __construct() {
        // Código de inicialização do plugin aqui...
    }

    /**
     * Inicializa as hooks do plugin.
     */
    public function initPlugin() {
        // Adicione as ações e filtros do WordPress aqui...
        // Init Settings
        $options = SendPostSettings::getInstance();
        $options->initSettings();

        // Init Hooks plugin
        $hooks = SendPostHooks::getInstance();
        $hooks->initHooks();
    }

    public static function activate() {
        // Activate plugin
        // Rewrite permalinks of Wordpress
        update_option( 'rewrite_rules', '' );
    }

    public static function deactivate() {
        // Deactivate plugin
        // Rewrite permalinks of Wordpress
        flush_rewrite_rules();
    }

    public static function uninstall() {
        // Uninstall plugin
    }

}