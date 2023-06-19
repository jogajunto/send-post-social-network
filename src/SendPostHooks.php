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

        // webhook url
        $url = 'https://hooks.zapier.com/hooks/catch/15470395/3hkw1xn/';
        $args = array(
            'method' => 'POST',
            'headers' => array(
                'Content-Type' => 'application/json'
            ),
            'body' => json_encode($data)
        );

        // sending data to webhook
        $response = wp_remote_post($url, $args);
        
    }
}