

# [WordPress plugin](https://magma.app)



# Welcome to Magma

Magma is the first Ambassador Led Growth platform to connect your best ambassadors with your prospects and boost your sales cycle.

**[Installation & configuration tutorial (FR / EN)](TUTORIAL.md)**

## What you can do with this plugin

Embed Magma widgets, banners, profile blocks, embeds, and galleries on your WordPress website.

## Available integrations

- [x] Shortcode
- [x] Elementor
- [x] Gutenberg
- [x] ACF (field group + ACF PRO block)



## Shortcodes

```text
[magma type="profile-block"]
[magma type="embed"]
[magma type="gallery"]
```



## Gutenberg

Insert the **Magma** block and choose the integration type in the block sidebar.

## ACF

When Advanced Custom Fields is active, Magma registers a **Magma Embed** field group (`magma_embed_type`) on posts and pages.

In a theme template:

```php
echo magma_render_integration( get_field( 'magma_embed_type' ) ?: 'profile-block' );
```

With ACF PRO, a **Magma (ACF)** block is also available in the editor.

## Widget CDN version

The Magma initializer is pinned to tag `v4.0.30` via `MAGMA_WIDGET_VERSION` in `index.php`. Bump that constant after testing a newer [magma-widget](https://github.com/magma-app/magma-widget) release.