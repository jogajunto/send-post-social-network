# WordPress Plugin - Send Post to Social Network

This WordPress plugin allows you to send your WordPress posts to a specified Zapier endpoint, which can then distribute the content across various social networks.

## Table of Contents

- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Troubleshooting](#troubleshooting)

## Installation

1. Download the plugin files.
2. Upload the plugin files to the `/wp-content/plugins/` directory, or install the plugin through the WordPress plugins screen directly.
3. Activate the plugin through the 'Plugins' screen in WordPress.

## Configuration

1. Navigate to the plugin settings page (the location of this page will depend on how the plugin is set up, typically it is located in the WordPress admin sidebar).
2. Execute in bash `composer dump-autoload` for generate autoload classes.
3. Enter your Zapier endpoint URL into the 'Zapier Endpoint URL' field.
4. Save your changes.

## Usage

1. Navigate to the 'Posts' page in the WordPress admin area.
2. You'll notice a new column titled 'Social'.
3. For each post, if it has been published and sent to social networks, you will see the message "Enviado para Redes Sociais" (Sent to Social Networks).
4. If the post hasn't been sent to social networks, you'll see a button that says "Enviar para Redes Sociais" (Send to Social Networks). Click this button to send the post to your specified Zapier endpoint.

## Troubleshooting

If you click the "Send to Social Networks" button and the post is successfully sent, an alert message "Postagem enviada com sucesso!" (Post sent successfully!) will be displayed. If the request fails, an error message will be shown.

If you encounter any issues, please check the following:

- Ensure the Zapier endpoint URL has been entered correctly in the plugin settings.
- Verify your Zapier endpoint is correctly configured to receive the post data and distribute it to your social networks.
- Check the status of the post. The plugin is designed to work with published posts.
