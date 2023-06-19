<?php

namespace SendPostSocialNetwork;

class SendPostInit {
    /**
     * Versão do Plugin.
     */
    const VERSION = '1.0.0';

    /**
     * Instância única deste plugin.
     */
    protected static $instance = null;

    /**
     * Retorna uma instância única deste plugin.
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

    public static function activate() {
        // Activate plugin
        error_log( print_r( 'Activate plugin', true ) );
    }

    public static function deactivate() {
        // Deactivate plugin
        error_log( print_r( 'Deactivate plugin', true ) );
    }

    public static function uninstall() {
        // Uninstall plugin
        error_log( print_r( 'Uninstall plugin', true ) );
    }

    /**
     * Inicializa as hooks do plugin.
     */
    public function initPlugin() {
        // Adicione as ações e filtros do WordPress aqui...
    }
}