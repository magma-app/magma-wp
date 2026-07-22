<?php
/**
 * Shared Magma integration markup renderer.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Allowed Magma embed types.
 *
 * @return string[]
 */
function magma_get_integration_types() {
	return array( 'profile-block', 'embed', 'gallery' );
}

/**
 * Render Magma integration HTML for a given type.
 *
 * @param string $type Integration type: profile-block|embed|gallery.
 * @return string
 */
function magma_render_integration( $type ) {
	$type = sanitize_key( (string) $type );

	if ( ! in_array( $type, magma_get_integration_types(), true ) ) {
		$type = 'profile-block';
	}

	switch ( $type ) {
		case 'embed':
			$campaign_id = rawurlencode( (string) get_option( 'magma_campaign_id' ) );
			$src         = 'https://dashboard.magma.app/helpee-signup/' . $campaign_id;
			return sprintf(
				'<iframe src="%s" style="display: block; margin: 0 auto; width: 90%%; height: 850px; border: none; background-color: #ffffff"></iframe>',
				esc_url( $src )
			);

		case 'gallery':
			return '<div id="magma-app_gallery"></div>';

		case 'profile-block':
		default:
			return '<div id="magma-app_block" style="width: 100%; height: 350px;"></div>';
	}
}
