<?php
/*
Plugin Name: Magma Ambassador
Plugin URI: https://www.magma.app/
Description: Integrate Magma to your WordPress website
Author: Magma
Version: 1.1.0
Author URI: https://magma.app
Requires at least: 4.3
Tested up to: 6.6
Stable tag: 6.6
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'MAGMA_PLUGIN_VERSION', '1.1.0' );
define( 'MAGMA_WIDGET_VERSION', 'v4.0.30' );
define( 'MAGMA_PLUGIN_FILE', __FILE__ );
define( 'MAGMA_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

require_once MAGMA_PLUGIN_DIR . 'includes/render.php';
require_once MAGMA_PLUGIN_DIR . 'includes/acf.php';

/**
 * Add a Settings link on the Plugins list row.
 *
 * @param string[] $actions Existing plugin action links.
 * @return string[]
 */
function magma_plugin_action_links( $actions ) {
	$settings_url = admin_url( 'options-general.php?page=magma-settings' );
	$settings_link = sprintf(
		'<a href="%s">%s</a>',
		esc_url( $settings_url ),
		esc_html__( 'Settings', 'magma' )
	);

	return array_merge( array( 'settings' => $settings_link ), $actions );
}
add_filter( 'plugin_action_links_' . plugin_basename( MAGMA_PLUGIN_FILE ), 'magma_plugin_action_links' );

/**
 * Enqueue Magma admin assets on the settings page.
 *
 * @param string $hook_suffix Current admin page hook.
 */
function magma_admin_style( $hook_suffix ) {
	if ( 'settings_page_magma-settings' !== $hook_suffix ) {
		return;
	}

	wp_enqueue_style(
		'magma-admin-style',
		plugins_url( 'style.css', __FILE__ ),
		array(),
		MAGMA_PLUGIN_VERSION
	);
	wp_enqueue_script(
		'magma-admin-script',
		plugins_url( 'app.js', __FILE__ ),
		array(),
		MAGMA_PLUGIN_VERSION,
		true
	);
}
add_action( 'admin_enqueue_scripts', 'magma_admin_style' );

/**
 * Enqueue Magma widget initializer on the front when a campaign is configured.
 */
function magma_script_tag() {
	$campaign_id = get_option( 'magma_campaign_id' );
	if ( empty( $campaign_id ) ) {
		return;
	}

	$script_url = sprintf(
		'https://cdn.jsdelivr.net/gh/magma-app/magma-widget@%s/src/widget/initializer.js',
		rawurlencode( MAGMA_WIDGET_VERSION )
	);

	wp_enqueue_script(
		'magma-script',
		$script_url,
		array(),
		MAGMA_WIDGET_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'magma_script_tag' );

/**
 * Add async to the Magma initializer script tag.
 *
 * @param string $tag    Script HTML tag.
 * @param string $handle Script handle.
 * @param string $src    Script source URL.
 * @return string
 */
function magma_script_loader_tag( $tag, $handle, $src ) {
	if ( 'magma-script' !== $handle ) {
		return $tag;
	}

	if ( false !== strpos( $tag, ' async' ) ) {
		return $tag;
	}

	return str_replace( ' src', ' async src', $tag );
}
add_filter( 'script_loader_tag', 'magma_script_loader_tag', 10, 3 );

/**
 * Register Magma settings page.
 */
function magma_menu() {
	add_options_page( 'Magma Settings', 'Magma', 'manage_options', 'magma-settings', 'magma_settings_page' );
}
add_action( 'admin_menu', 'magma_menu' );

/**
 * Render Magma settings page.
 */
function magma_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?>
	<div class="magma_container">
		<img src="https://assets-global.website-files.com/613b62a6417331070454f544/648b020e4b7fc1b0d975a0b3_logo-magma.svg" alt="Magma Logo" class="logo">
		<form class="connect" method="post" action="options.php">
			<?php settings_fields( 'magma-settings-group' ); ?>
			<?php do_settings_sections( 'magma-settings-group' ); ?>
			<label>
				<span>Enter your Magma Campaign ID</span>
				<input type="text" id="campaign-id" name="magma_campaign_id" value="<?php echo esc_attr( get_option( 'magma_campaign_id' ) ); ?>">
			</label>
			<input type="hidden" id="magma_widget_top_left" name="magma_widget_top_left">
			<input type="hidden" id="magma_widget_top_right" name="magma_widget_top_right">
			<input type="hidden" id="magma_widget_bottom_left" name="magma_widget_bottom_left">
			<input type="hidden" id="magma_widget_bottom_right" name="magma_widget_bottom_right">
			<input type="hidden" id="magma_widget_banner_top" name="magma_widget_banner_top">
			<input type="hidden" id="magma_widget_banner_bottom" name="magma_widget_banner_bottom">
			<input type="hidden" id="magma_widget_block" name="magma_widget_block">
			<input type="hidden" id="magma_widget_gallery" name="magma_widget_gallery">
			<button type="submit">Connect</button>
		</form>

		<span class="error-connect"></span>

		<?php if ( get_option( 'magma_campaign_id' ) ) { ?>
			<?php
			$one    = get_option( 'magma_widget_top_left' );
			$two    = get_option( 'magma_widget_top_right' );
			$three  = get_option( 'magma_widget_bottom_left' );
			$four   = get_option( 'magma_widget_bottom_right' );
			$five   = get_option( 'magma_widget_banner_top' );
			$six    = get_option( 'magma_widget_banner_bottom' );
			$seven  = get_option( 'magma_widget_block' );
			$eight  = get_option( 'magma_widget_gallery' );
			?>

			<div>
				<form class="widgets" method="post" action="options.php">
					<?php settings_fields( 'magma-settings-group' ); ?>
					<?php do_settings_sections( 'magma-settings-group' ); ?>
					<input type="hidden" name="magma_campaign_id" value="<?php echo esc_attr( get_option( 'magma_campaign_id' ) ); ?>">
					<input type="hidden" id="magma_widget_top_left" name="magma_widget_top_left" value="<?php echo esc_attr( $one ); ?>">
					<input type="hidden" id="magma_widget_top_right" name="magma_widget_top_right" value="<?php echo esc_attr( $two ); ?>">
					<input type="hidden" id="magma_widget_bottom_left" name="magma_widget_bottom_left" value="<?php echo esc_attr( $three ); ?>">
					<input type="hidden" id="magma_widget_bottom_right" name="magma_widget_bottom_right" value="<?php echo esc_attr( $four ); ?>">
					<input type="hidden" id="magma_widget_banner_top" name="magma_widget_banner_top" value="<?php echo esc_attr( $five ); ?>">
					<input type="hidden" id="magma_widget_banner_bottom" name="magma_widget_banner_bottom" value="<?php echo esc_attr( $six ); ?>">
					<input type="hidden" id="magma_widget_block" name="magma_widget_block" value="<?php echo esc_attr( $seven ); ?>">
					<input type="hidden" id="magma_widget_gallery" name="magma_widget_gallery" value="<?php echo esc_attr( $eight ); ?>">
					<label>
						<span>Which integration do you want?</span>
						<div>
							<select name="magma_widget_selected" id="magma_widget_selected">
								<option value="" <?php selected( (string) get_option( 'magma_widget_selected' ), '' ); ?>>
									Do not show integration on the whole website
								</option>
								<?php if ( $one ) : ?>
									<option value="<?php echo esc_attr( $one ); ?>" <?php selected( get_option( 'magma_widget_selected' ), $one ); ?>>
										Widget - Top Left
									</option>
								<?php endif; ?>
								<?php if ( $two ) : ?>
									<option value="<?php echo esc_attr( $two ); ?>" <?php selected( get_option( 'magma_widget_selected' ), $two ); ?>>
										Widget - Top Right
									</option>
								<?php endif; ?>
								<?php if ( $three ) : ?>
									<option value="<?php echo esc_attr( $three ); ?>" <?php selected( get_option( 'magma_widget_selected' ), $three ); ?>>
										Widget - Bottom Left
									</option>
								<?php endif; ?>
								<?php if ( $four ) : ?>
									<option value="<?php echo esc_attr( $four ); ?>" <?php selected( get_option( 'magma_widget_selected' ), $four ); ?>>
										Widget - Bottom Right
									</option>
								<?php endif; ?>
								<?php if ( $five ) : ?>
									<option value="<?php echo esc_attr( $five ); ?>" <?php selected( get_option( 'magma_widget_selected' ), $five ); ?>>
										Banner Top
									</option>
								<?php endif; ?>
								<?php if ( $six ) : ?>
									<option value="<?php echo esc_attr( $six ); ?>" <?php selected( get_option( 'magma_widget_selected' ), $six ); ?>>
										Banner Bottom
									</option>
								<?php endif; ?>
							</select>
							<?php if ( ! ( $one || $two || $three || $four || $five || $six ) ) : ?>
								<p>No corner widget or banner is available yet. Configure one in the Magma admin panel, or keep site-wide integrations hidden.</p>
							<?php endif; ?>
						</div>
					</label>
					<button type="submit">Save</button>
				</form>
			</div>

			<div class="shortcode">
				<h2>Shortcode</h2>
				<p>Use this shortcode to embed Magma integrations anywhere on your website</p>

				<div>
					<span>Profile block</span>
					<code>[magma type="profile-block"]</code>
				</div>

				<div>
					<span>Embed</span>
					<code>[magma type="embed"]</code>
				</div>

				<div>
					<span>Gallery</span>
					<code>[magma type="gallery"]</code>
				</div>
			</div>
		<?php } ?>
	</div>
	<?php
}

/**
 * Register Magma plugin settings.
 */
function magma_settings() {
	register_setting( 'magma-settings-group', 'magma_campaign_id' );
	register_setting( 'magma-settings-group', 'magma_widget_top_left' );
	register_setting( 'magma-settings-group', 'magma_widget_top_right' );
	register_setting( 'magma-settings-group', 'magma_widget_bottom_left' );
	register_setting( 'magma-settings-group', 'magma_widget_bottom_right' );
	register_setting( 'magma-settings-group', 'magma_widget_banner_top' );
	register_setting( 'magma-settings-group', 'magma_widget_banner_bottom' );
	register_setting( 'magma-settings-group', 'magma_widget_selected' );
	register_setting( 'magma-settings-group', 'magma_widget_block' );
	register_setting( 'magma-settings-group', 'magma_widget_gallery' );
}
add_action( 'admin_init', 'magma_settings' );

/**
 * Inject window.magma_app configuration in the document head.
 */
function magma_id_script_tag() {
	$magma_campaign_id = get_option( 'magma_campaign_id' );
	if ( empty( $magma_campaign_id ) ) {
		return;
	}

	$entries = array();
	$uuids   = array_filter(
		array(
			get_option( 'magma_widget_selected' ),
			get_option( 'magma_widget_block' ),
			get_option( 'magma_widget_gallery' ),
		)
	);

	foreach ( $uuids as $integration_uuid ) {
		$entries[] = sprintf(
			"{type:'campaignUuid',uuid:'%s',integrationUuid:'%s'}",
			esc_js( $magma_campaign_id ),
			esc_js( $integration_uuid )
		);
	}

	if ( empty( $entries ) ) {
		return;
	}

	echo '<script>window.magma_app=[' . implode( ',', $entries ) . '];</script>' . "\n";
}
add_action( 'wp_head', 'magma_id_script_tag' );

/**
 * Magma shortcode handler.
 *
 * @param array|string $atts Shortcode attributes.
 * @return string
 */
function magma_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'type' => 'profile-block',
		),
		$atts,
		'magma'
	);

	return magma_render_integration( $atts['type'] );
}
add_shortcode( 'magma', 'magma_shortcode' );

/**
 * Register the Magma Gutenberg block.
 */
function magma_register_gutenberg_block() {
	wp_register_script(
		'magma-embed-editor',
		plugins_url( 'blocks/magma/edit.js', __FILE__ ),
		array( 'wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components', 'wp-i18n' ),
		MAGMA_PLUGIN_VERSION,
		true
	);

	wp_register_style(
		'magma-embed-editor',
		plugins_url( 'blocks/magma/editor.css', __FILE__ ),
		array(),
		MAGMA_PLUGIN_VERSION
	);

	register_block_type(
		MAGMA_PLUGIN_DIR . 'blocks/magma',
		array(
			'editor_script'   => 'magma-embed-editor',
			'editor_style'    => 'magma-embed-editor',
			'render_callback' => 'magma_gutenberg_render_callback',
		)
	);
}
add_action( 'init', 'magma_register_gutenberg_block' );

/**
 * Render callback for the Magma Gutenberg block.
 *
 * @param array $attributes Block attributes.
 * @return string
 */
function magma_gutenberg_render_callback( $attributes ) {
	$type = isset( $attributes['type'] ) ? $attributes['type'] : 'profile-block';
	return magma_render_integration( $type );
}

/**
 * Register Magma Elementor widgets.
 *
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 */
function register_magma_widgets( $widgets_manager ) {
	require_once MAGMA_PLUGIN_DIR . 'elementor-addon/widgets/magma-embed.php';
	require_once MAGMA_PLUGIN_DIR . 'elementor-addon/widgets/magma-profile-block.php';
	require_once MAGMA_PLUGIN_DIR . 'elementor-addon/widgets/magma-gallery.php';

	$widgets_manager->register( new \Elementor_Magma_Embed() );
	$widgets_manager->register( new \Elementor_Magma_Profile_Block() );
	$widgets_manager->register( new \Elementor_Magma_Gallery() );
}
add_action( 'elementor/widgets/register', 'register_magma_widgets' );
