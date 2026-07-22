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
		return array( 'basic' );
	}

	public function get_keywords() {
		return array( 'magma', 'embed' );
	}

	protected function render() {
		echo magma_render_integration( 'embed' );
	}

	protected function content_template() {
		$magma_campaign_id = esc_attr( (string) get_option( 'magma_campaign_id' ) );
		?>
		<iframe src='https://dashboard.magma.app/helpee-signup/<?php echo $magma_campaign_id; ?>' style='display: block; margin: 0 auto; width: 90%; height: 850px; border: none; background-color: #ffffff'></iframe>
		<?php
	}
}
