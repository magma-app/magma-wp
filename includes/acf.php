<?php
/**
 * Optional ACF integration for Magma.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Magma ACF field groups and optional ACF PRO block.
 */
function magma_register_acf_integration() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	$choices = array(
		'profile-block' => 'Profile Block',
		'embed'         => 'Embed',
		'gallery'       => 'Gallery',
	);

	acf_add_local_field_group(
		array(
			'key'                   => 'group_magma_embed',
			'title'                 => 'Magma Embed',
			'fields'                => array(
				array(
					'key'           => 'field_magma_embed_type',
					'label'         => 'Integration type',
					'name'          => 'magma_embed_type',
					'type'          => 'select',
					'instructions'  => 'Choose which Magma integration to render. Campaign UUIDs are configured under Settings → Magma.',
					'required'      => 0,
					'choices'       => $choices,
					'default_value' => 'profile-block',
					'allow_null'    => 0,
					'return_format' => 'value',
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'post',
					),
				),
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'page',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'side',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'active'                => true,
		)
	);

	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return;
	}

	acf_register_block_type(
		array(
			'name'            => 'magma-acf',
			'title'           => 'Magma (ACF)',
			'description'     => 'Embed a Magma integration using ACF fields.',
			'render_callback' => 'magma_acf_block_render',
			'category'        => 'widgets',
			'icon'            => 'groups',
			'keywords'        => array( 'magma', 'gallery', 'ambassador', 'embed' ),
			'mode'            => 'edit',
			'supports'        => array(
				'align' => false,
				'mode'  => true,
			),
		)
	);

	acf_add_local_field_group(
		array(
			'key'                   => 'group_magma_acf_block',
			'title'                 => 'Magma (ACF) Block',
			'fields'                => array(
				array(
					'key'           => 'field_magma_acf_block_type',
					'label'         => 'Integration type',
					'name'          => 'magma_embed_type',
					'type'          => 'select',
					'required'      => 1,
					'choices'       => $choices,
					'default_value' => 'profile-block',
					'allow_null'    => 0,
					'return_format' => 'value',
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'block',
						'operator' => '==',
						'value'    => 'acf/magma-acf',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'active'                => true,
		)
	);
}
add_action( 'acf/init', 'magma_register_acf_integration' );

/**
 * Render callback for the Magma ACF PRO block.
 *
 * @param array $block Block settings.
 */
function magma_acf_block_render( $block ) {
	$type = function_exists( 'get_field' ) ? get_field( 'magma_embed_type' ) : 'profile-block';
	echo magma_render_integration( $type ? $type : 'profile-block' );
}
