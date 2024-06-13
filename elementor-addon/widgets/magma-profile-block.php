<?php
class Elementor_Magma_Profile_Block extends \Elementor\Widget_Base {

	public function get_name() {
		return 'magma_profile-block';
	}

	public function get_title() {
		return esc_html__( 'Magma Profile Block', 'elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	public function get_keywords() {
		return [ 'magma', 'profile', 'block' ];
	}

	protected function render() {
		?>
		<div id="magma-app_block" style="width: 100%; height: 350px;"></div>
		<?php
	}

	protected function content_template() {
		?>
		<div id="magma-app_block" style="width: 100%; height: 350px;"></div>
		<?php
	}
}