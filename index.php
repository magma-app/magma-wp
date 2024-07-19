<?php
/*
Plugin Name: Magma
Plugin URI: https://magma.app
Description: Integrate Magma to your WordPress website
Author: Magma
Version: 1.0.0
Author URI: https://magma.app
Requires at least: 4.3
Tested up to: 6.6
Stable tag: 6.6
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

/* Add Magma CSS on the administration from ./style.css */
function magma_admin_style() {
    wp_enqueue_style('magma-admin-style', plugins_url('style.css', __FILE__));
    wp_enqueue_script('magma-admin-script', plugins_url('app.js', __FILE__));
}

add_action('admin_enqueue_scripts', 'magma_admin_style');


// add wp_enqueue_script instead off echo script tag
function magma_script_tag() {
    wp_enqueue_script('magma-script', 'https://cdn.jsdelivr.net/gh/magma-app/magma-widget@latest/src/widget/initializer.js', array(), null, true);
}

add_action('wp_enqueue_scripts', 'magma_script_tag');

/* Create an option page to handle ID check  */

function magma_menu() {
    add_options_page('Magma Settings', 'Magma', 'manage_options', 'magma-settings', 'magma_settings_page');
}

add_action('admin_menu', 'magma_menu');

function magma_settings_page() {
    ?>
    

    <div class="magma_container">
        <img src="https://assets-global.website-files.com/613b62a6417331070454f544/648b020e4b7fc1b0d975a0b3_logo-magma.svg" alt="Magma Logo" class="logo">
        <form class="connect" method="post" action="options.php">
            <?php settings_fields('magma-settings-group'); ?>
            <?php do_settings_sections('magma-settings-group'); ?>
            <label>
                <span>Enter your Magma Campaign ID</span>
                <input type="text" id="campaign-id" name="magma_campaign_id" value="<?php echo esc_attr(get_option('magma_campaign_id')); ?>">
            </label>
            <input type="hidden" id="magma_widget_top_left" name="magma_widget_top_left">
            <input type="hidden" id="magma_widget_top_right" name="magma_widget_top_right">
            <input type="hidden" id="magma_widget_bottom_left" name="magma_widget_bottom_left">
            <input type="hidden" id="magma_widget_bottom_right" name="magma_widget_bottom_right">
            <input type="hidden" id="magma_widget_banner_top" name="magma_widget_banner_top">
            <input type="hidden" id="magma_widget_banner_bottom" name="magma_widget_banner_bottom">
            <input type="hidden" id="magma_widget_block" name="magma_widget_block">
            <button type="submit">Connect</button>
        </form>



        <span class="error-connect"></span>




        <?php if (get_option('magma_campaign_id')) { ?>
            <?php
                $one = get_option('magma_widget_top_left');
                $two = get_option('magma_widget_top_right');
                $three = get_option('magma_widget_bottom_left');
                $four = get_option('magma_widget_bottom_right');
                $five = get_option('magma_widget_banner_top');
                $six = get_option('magma_widget_banner_bottom');
                $seven = get_option('magma_widget_block');
            ?>


            <div>
                <form class="widgets" method="post" action="options.php">
                    <?php settings_fields('magma-settings-group'); ?>
                    <?php do_settings_sections('magma-settings-group'); ?>
                    <input type="hidden" name="magma_campaign_id" value="<?php echo esc_attr(get_option('magma_campaign_id')); ?>">
                    <input type="hidden" id="magma_widget_top_left" name="magma_widget_top_left" value="<?php echo esc_attr($one); ?>">
                    <input type="hidden" id="magma_widget_top_right" name="magma_widget_top_right" value="<?php echo esc_attr($two); ?>">
                    <input type="hidden" id="magma_widget_bottom_left" name="magma_widget_bottom_left" value="<?php echo esc_attr($three); ?>">
                    <input type="hidden" id="magma_widget_bottom_right" name="magma_widget_bottom_right" value="<?php echo esc_attr($four); ?>">
                    <input type="hidden" id="magma_widget_banner_top" name="magma_widget_banner_top" value="<?php echo esc_attr($five); ?>">
                    <input type="hidden" id="magma_widget_banner_bottom" name="magma_widget_banner_bottom" value="<?php echo esc_attr($six); ?>">
                    <input type="hidden" id="magma_widget_block" name="magma_widget_block" value="<?php echo esc_attr($seven); ?>">
                    <label>
                        <span>Which integration do you want?</span>
                        <div>

                            <?php if($one || $two || $three || $four || $five || $six): ?>

                            <select name="magma_widget_selected" id="magma_widget_selected" value="<?php echo esc_attr(get_option('magma_widget_selected')); ?>">
                                <?php if($one): ?>
                                    <option value="<?php echo esc_attr($one); ?>" 
                                    <?php if(get_option('magma_widget_selected') == $one) echo 'selected' ?> <?php if($one === '') echo 'disabled' ?>>
                                        Widget - Top Left
                                    </option>
                                <?php endif; ?>
                                <?php if($two): ?>
                                <option value="<?php echo esc_attr($two); ?>"
                                <?php if(get_option('magma_widget_selected') == $two) echo 'selected' ?> <?php if($two === '') echo 'disabled' ?>>
                                    Widget - Top Right
                                </option>
                                <?php endif; ?>
                                <?php if($three): ?>
                                <option value="<?php echo esc_attr($three); ?>"
                                <?php if(get_option('magma_widget_selected') == $three) echo 'selected' ?> <?php if($three === '') echo 'disabled' ?>>
                                    Widget - Bottom Left
                                </option>
                                <?php endif; ?>
                                <?php if($four): ?>
                                <option value="<?php echo esc_attr($four); ?>"
                                <?php if(get_option('magma_widget_selected') == $four) echo 'selected' ?> <?php if($four === '') echo 'disabled' ?>>
                                    Widget - Bottom Right
                                </option>
                                <?php endif; ?>
                                <?php if($five): ?>
                                <option value="<?php echo esc_attr($five); ?>"
                                <?php if(get_option('magma_widget_selected') == $five) echo 'selected' ?> <?php if($five === '') echo 'disabled' ?>>
                                    Banner Top
                                </option>
                                <?php endif; ?>
                                <?php if($six): ?>
                                <option value="<?php echo esc_attr($six); ?>"
                                <?php if(get_option('magma_widget_selected') == $six) echo 'selected' ?> <?php if($six === '') echo 'disabled' ?>>
                                   Banner Bottom
                                </option>
                                <?php endif; ?>
                            </select>

                            <?php else: ?>
                                <p>You must select an integration on the Magma admin panel</p>
                            <?php endif; ?>
                        </div>
                    </label>
                    <button type="submit">Save</button>
                </form>
            </div>

            <div class="shortcode">
                <h2>Shortcode</h2>
                <p>Use this shortcode to embed the Magma block anywhere on your website</p>

                <div>
                    <span>Profile block</span>
                    <code>[magma type="profile-block"]</code>
                </div>

                <div>
                    <span>Embed</span>
                    <code>[magma type="embed"]</code>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php
}

function magma_settings() {
    register_setting('magma-settings-group', 'magma_campaign_id');
    register_setting('magma-settings-group', 'magma_widget_top_left');
    register_setting('magma-settings-group', 'magma_widget_top_right');
    register_setting('magma-settings-group', 'magma_widget_bottom_left');
    register_setting('magma-settings-group', 'magma_widget_bottom_right');
    register_setting('magma-settings-group', 'magma_widget_banner_top');
    register_setting('magma-settings-group', 'magma_widget_banner_bottom');
    register_setting('magma-settings-group', 'magma_widget_selected');
    register_setting('magma-settings-group', 'magma_widget_block');
}

add_action('admin_init', 'magma_settings');

/* Add Magma ID to the script tag */

function magma_id_script_tag() {
    $magma_campaign_id = get_option('magma_campaign_id');
    $magma_integration_id = get_option('magma_widget_selected');
    $magma_block = get_option('magma_widget_block');
    echo "<script>
    window.magma_app = [
      {
        type: 'campaignUuid',
        uuid: '" . $magma_campaign_id . "',
        integrationUuid: '" . $magma_integration_id . "',
      },
      {
        type: 'campaignUuid',
        uuid: '" . $magma_campaign_id . "',
        integrationUuid: '" . $magma_block . "',
      },
    ];
  </script>";
}

add_action('wp_head', 'magma_id_script_tag');

/* Create a shortcode to embed magma block everywhere */

function magma_shortcode($atts) {
    $a = shortcode_atts(array(
        'type' => 'profile-block',
    ), $atts);

    $magma_type = $a['type'];
    $magma_campaign_id = get_option('magma_campaign_id');

    // Switch between the type of block
    switch ($magma_type) {
        case 'profile-block':
            return '<div id="magma-app_block" style="width: 100%; height: 350px;"></div>';
        case 'embed':
            return "<iframe src='https://dashboard.magma.app/helpee-signup/" . $magma_campaign_id . "' style='display: block; margin: 0 auto; width: 90%; height: 850px; border: none; background-color: #ffffff'></iframe>";
        default:
            return '<div id="magma-app_block" style="width: 100%; height: 350px;"></div>';
    }
}

add_shortcode('magma', 'magma_shortcode');

// Elementor
function register_magma_widgets( $widgets_manager ) {

	require_once( __DIR__ . '/elementor-addon/widgets/magma-embed.php' );
	require_once( __DIR__ . '/elementor-addon/widgets/magma-profile-block.php' );

	$widgets_manager->register( new \Elementor_Magma_Embed() );
	$widgets_manager->register( new \Elementor_Magma_Profile_Block() );

}
add_action( 'elementor/widgets/register', 'register_magma_widgets' );

?>