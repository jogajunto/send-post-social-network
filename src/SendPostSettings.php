<?php 

namespace SendPostSocialNetwork;

class SendPostSettings
{
    /**
     * Instância única desta classe.
     */
    protected static $instance = null;

    public static $options;

    public function __construct()
    {
        // Todo
    }

    public function initSettings()
    {
        self::$options = get_option( 'send_post_social_network_options' );
        // Admin init
        add_action( 'admin_init', array( $this, 'admin_init' ) );
        // Admin menu
        add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
    }

    /**
     * Retorna uma instância única desta classe.
     */
    public static function getInstance() {
        if ( null == self::$instance ) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function admin_init()
    {
        // Save options for plugin SendPostSocialNetwork
        register_setting( 
            'send_post_social_network_group', 
            'send_post_social_network_options',
            array( $this, 'send_post_social_network_options_validate' )
        );

        // Add section for fields in options page
        add_settings_section(
            'send_post_social_network_main_section',
            'Informe a URL do endpoint para o envio dos posts',
            null,
            'send_post_social_network_page1'
        );

        // Add field endpoint in section main
        add_settings_field(
            'zapier_endpoint_url',
            'Endpoint do Zapier:',
            array( $this, 'zapier_endpoint_url_callback' ),
            'send_post_social_network_page1',
            'send_post_social_network_main_section'
        );
    }

    public function add_admin_menu()
    {
        // Menu page for configs plugin
        add_menu_page(
            'Send Posts Zapier Options',
            'Send Posts Zapier',
            'manage_options',
            'send_post_social_network_admin',
            array( $this, 'send_post_social_network_settings_page' ),
            'dashicons-shortcode',
            // 10
        );
    }

    // Show view for send_post_social_network_settings_page
    public function send_post_social_network_settings_page() {
        if( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        if( isset( $_GET['settings-updated'] ) ) {
            add_settings_error( 'send_post_social_network_options', 'send_post_social_network_message', 'Settings Saved', 'success' );
        }

        settings_errors( 'send_post_social_network_options' );

        require( SEND_POST_SOCIAL_NETWORK_PATH . 'views/settings-page.php' );
    }

    public function zapier_endpoint_url_callback()
    {
        ?>
        <input 
            type="text"
            name="send_post_social_network_options[zapier_endpoint_url]" 
            id="zapier_endpoint_url" 
            style="width: 100%;"
            <?php echo isset( self::$options['zapier_endpoint_url'] ) ? 'value="'.esc_textarea( self::$options['zapier_endpoint_url'] ).'"' : null; ?>
        />
        <?php
    }

    public function send_post_social_network_options_validate( Array $input )
    {
        $new_input = array();
        foreach( $input as $key => $value ) {
            switch( $key ) {
                case 'zapier_endpoint_url':
                    $new_input[$key] = esc_url( $value );
                    break;
                default:
                    add_settings_error(
                        'send_post_social_network_options',
                        'send_post_social_network_message',
                        'Parametros incorretos!!!',
                        'warning'
                    );
                    break;
            }
        }
        return $new_input;
    }
}