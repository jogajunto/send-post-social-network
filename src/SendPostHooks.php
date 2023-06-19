<?php

namespace SendPostSocialNetwork;

class SendPostHooks
{
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

    public function initHooks()
    {
        add_filter('manage_posts_columns', array( $this, 'social_post_column' ));
        add_action('manage_posts_custom_column', array( $this, 'social_post_column_content' ), 10, 2);
        add_action('admin_enqueue_scripts', array( $this, 'enqueue_social_scripts' ));
        add_action('wp_ajax_send_to_social', array( $this, 'send_to_social' ));
    }
    
    /**
     * Send Post_data for webhook url
     */
    public function send_post_data_to_webhook( Int $post_id ) {
        $post_title = get_the_title($post_id);
        $post_excerpt = get_the_excerpt($post_id);
        $post_url = get_permalink($post_id);
        $post_featured_image_url = '';

        // Obtém o ID da imagem de destaque
        $thumbnail_ID = get_post_thumbnail_id($post_id);

        // Verifica se a imagem de destaque está definida
        if ($thumbnail_ID) {
            // Obtém a URL da imagem de destaque
            $image_data = wp_get_attachment_image_src($thumbnail_ID, 'full');
            $post_featured_image_url = $image_data[0];
        }

        $data = array(
            'title' => $post_title,
            'excerpt' => $post_excerpt,
            'url' => $post_url,
            'featured_image_url' => $post_featured_image_url
        );

        $args = array(
            'method' => 'POST',
            'headers' => array(
                'Content-Type' => 'application/json'
            ),
            'body' => json_encode($data)
        );

        if( ! empty( get_option( 'send_post_social_network_options' ) ) && isset( get_option( 'send_post_social_network_options' )['zapier_endpoint_url'] ) )
        {
            // webhook url
            $url = get_option( 'send_post_social_network_options' )['zapier_endpoint_url'];

            // sending data to webhook
            $response = wp_remote_post($url, $args);
            
            // Check if the request was successful
            if( is_wp_error( $response ) ) {
                wp_send_json_error( 'There was an error making the request.' );
                die();
            } else {
                $body = wp_remote_retrieve_body( $response );
                $data = json_decode( $body );

                // Após enviar para o Zapier, atualize o meta_value
                update_post_meta($post_id, 'social_published', true);

                wp_send_json_success( $data );
            }
        } else {
            wp_send_json_error( 'Not endpoint url in settings.' );
            die();
        }
        
    }

    // Adicionar coluna personalizada na listagem dos posts
    public function social_post_column($columns) {
        $columns['social'] = 'Social';
        return $columns;
    }

    // Exibir conteúdo da coluna personalizada
    public function social_post_column_content($column_name, $post_id) {
        if ($column_name == 'social') {
            $is_published = get_post_meta($post_id, 'social_published', true);
            $post_status = get_post_status($post_id);
            if( $post_status == 'publish' )
            {
                if ($is_published) {
                    echo 'Enviado para Redes Sociais';
                } else {
                    echo '<button class="social-button" data-postid="' . $post_id . '">Enviar para Redes Sociais</button>';
                }
            } else {
                echo 'O post tem que estar publicado';
            }
        }
    }

    // Adicionar scripts e estilos para a funcionalidade do botão
    public function enqueue_social_scripts() {
        wp_enqueue_script('jquery');
        wp_enqueue_script('social-script', SEND_POST_SOCIAL_NETWORK_URL . '/assets/js/send-to-social.js', array('jquery'), '1.0', true);
        wp_localize_script('social-script', 'custom_vars', array(
            'ajax_url' => admin_url('admin-ajax.php')
        ));
    }

    // Manipular a requisição AJAX para enviar dados para o Zapier e atualizar o meta_value
    public function send_to_social() {
        if (isset($_POST['post_id'])) {
            $post_id = intval($_POST['post_id']);
            // Aqui você deve chamar sua função de envio da requisição para o Zapier
            $this->send_post_data_to_webhook($post_id);
        }
        wp_die();
    }
}