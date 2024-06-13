<?php
class Elementor_Magma_Embed extends \Elementor\Widget_Base {

	public function get_name() {
		return 'magma_embed';
	}

	public function get_title() {
		return esc_html__( 'Magma Embed', 'elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	public function get_keywords() {
		return [ 'magma', 'embed' ];
	}

	protected function render() {

    $magma_campaign_id = get_option('magma_campaign_id');

		?>
		<iframe src='https://dashboard.magma.app/helpee-signup/<?php echo $magma_campaign_id ?>' style='display: block; margin: 0 auto; width: 90%; height: 850px; border: none; background-color: #ffffff'></iframe>
		<?php
	}

	protected function content_template() {

    $magma_campaign_id = get_option('magma_campaign_id');

		?>
		<iframe src='https://dashboard.magma.app/helpee-signup/<?php echo $magma_campaign_id ?>' style='display: block; margin: 0 auto; width: 90%; height: 850px; border: none; background-color: #ffffff'></iframe>
		<?php
	}
}