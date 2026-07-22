<?php
class Elementor_Magma_Gallery extends \Elementor\Widget_Base {

	public function get_name() {
		return 'magma_gallery';
	}

	public function get_title() {
		return esc_html__( 'Magma Gallery', 'elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return array( 'basic' );
	}

	public function get_keywords() {
		return array( 'magma', 'gallery' );
	}

	protected function render() {
		echo magma_render_integration( 'gallery' );
	}

	protected function content_template() {
		?>
		<div id="magma-app_gallery"></div>
		<?php
	}
}
