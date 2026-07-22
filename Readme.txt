=== Magma.app ===

Contributors: yourname

Tags: business, directory, ambassador, magma

Requires at least: 4.3

Tested up to: 6.6

Stable tag: 6.6

License: GPLv3

License URI: http://www.gnu.org/licenses/gpl-3.0.html

Add your Magma.app widget on your WordPress website easily

== Description ==

Magma is the first Ambassador Led Growth platform to connect your best ambassadors with your prospects and boost your sales cycle.
With this plugin, you can easily add the Magma widget on your website

- Corner widgets
- Banner widgets
- Embed form
- Profile block
- Gallery
- Elementor widgets
- Gutenberg block
- ACF field group and ACF PRO block

== Installation ==
1. Upload [`magma-wp-main`](https://github.com/magma-app/magma-wp/archive/refs/heads/main.zip) to the `/wp-content/plugins/` directory

2. Activate the plugin through the 'Plugins' menu in WordPress
== Frequently Asked Questions ==
= What I need to use Magma? =
You need to be a customer of Magma.app to use it.
= Can I integrate multiple widget? =
You can use multiple embed forms, profile blocks, and galleries, but currently only one corner or banner widget.
= How do I use ACF? =
With ACF active, use the Magma Embed field or call `magma_render_integration( get_field( 'magma_embed_type' ) )` in your theme. ACF PRO also provides a Magma (ACF) block.
== Screenshots ==
/assets/screenshot-1.png
== Changelog ==
= v1.1.0 =

* Add Gallery shortcode, Elementor widget, and Gutenberg block
* Add optional ACF field group and ACF PRO block
* Shared renderer, conditional script loading, pinned widget CDN (v4.0.30)

= v1.0.0 =

* Initial release
