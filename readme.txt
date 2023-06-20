=== Send Posts Social Network ===
Contributors: Rafael de Araujo Procopio
Tags: zapier, social network, posts
Requires at least: 5.8
Tested up to: 5.8
Stable tag: 1.0.0
License: GPL-2.0-or-later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

This plugin allows you to send your WordPress posts to a specified Zapier endpoint, which can then distribute the content across various social networks.

== Installation ==

1. Download the plugin files.
2. Upload the plugin files to the `/wp-content/plugins/` directory. Execute `composer install` in the command line to generate autoload classes.
3. Activate the plugin through the 'Plugins' screen in WordPress.

== Configuration ==

1. Navigate to the plugin settings page (the location of this page will depend on how the plugin is set up, typically it is located in the WordPress admin sidebar).
2. Enter your Zapier endpoint URL into the 'Zapier Endpoint URL' field.
3. Save your changes.

== Usage ==

1. Navigate to the 'Posts' page in the WordPress admin area.
2. You'll notice a new column titled 'Social'.
3. For each post, if it has been published and sent to social networks, you will see the message "Enviado para Redes Sociais" (Sent to Social Networks).
4. If the post hasn't been sent to social networks, you'll see a button that says "Enviar para Redes Sociais" (Send to Social Networks). Click this button to send the post to your specified Zapier endpoint.

== Troubleshooting ==

If you click the "Send to Social Networks" button and the post is successfully sent, an alert message "Postagem enviada com sucesso!" (Post sent successfully!) will be displayed. If the request fails, an error message will be shown.

If you encounter any issues, please check the following:

- Ensure the Zapier endpoint URL has been entered correctly in the plugin settings.
- Verify your Zapier endpoint is correctly configured to receive the post data and distribute it to your social networks.
- Check the status of the post. The plugin is designed to work with published posts.
