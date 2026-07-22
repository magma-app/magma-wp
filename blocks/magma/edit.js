( function ( blocks, element, blockEditor, components, i18n ) {
	var el = element.createElement;
	var Fragment = element.Fragment;
	var InspectorControls = blockEditor.InspectorControls;
	var useBlockProps = blockEditor.useBlockProps;
	var PanelBody = components.PanelBody;
	var SelectControl = components.SelectControl;
	var __ = i18n.__;

	var typeLabels = {
		'profile-block': 'Profile Block',
		embed: 'Embed',
		gallery: 'Gallery',
	};

	blocks.registerBlockType( 'magma/embed', {
		edit: function ( props ) {
			var type = props.attributes.type || 'profile-block';
			var blockProps = useBlockProps( {
				className: 'magma-block-editor',
			} );

			return el(
				Fragment,
				null,
				el(
					InspectorControls,
					null,
					el(
						PanelBody,
						{
							title: __( 'Magma Settings', 'magma' ),
							initialOpen: true,
						},
						el( SelectControl, {
							label: __( 'Integration type', 'magma' ),
							value: type,
							options: [
								{ label: 'Profile Block', value: 'profile-block' },
								{ label: 'Embed', value: 'embed' },
								{ label: 'Gallery', value: 'gallery' },
							],
							onChange: function ( value ) {
								props.setAttributes( { type: value } );
							},
						} )
					)
				),
				el(
					'div',
					blockProps,
					el(
						'p',
						{ className: 'magma-block-editor__title' },
						'Magma — ' + ( typeLabels[ type ] || type )
					),
					el(
						'p',
						{ className: 'magma-block-editor__hint' },
						__( 'Visible on the front of the site.', 'magma' )
					)
				)
			);
		},
		save: function () {
			return null;
		},
	} );
} )(
	window.wp.blocks,
	window.wp.element,
	window.wp.blockEditor,
	window.wp.components,
	window.wp.i18n
);
