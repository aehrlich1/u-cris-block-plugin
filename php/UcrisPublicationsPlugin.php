<?php

class UcrisPublicationsPlugin {
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_page' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'update_option_ucris_api_key', array( $this, 'update_options' ), 10, 2 );
		add_action( 'update_option_ucris_person_id', array( $this, 'update_options' ), 10, 2 );
	}

	public function admin_page(): void {
		add_options_page(
			'ucris Settings',
			'u:cris',
			'manage_options',
			'ucris-publications-settings-page',
			[ $this, 'options_page' ]
		);
	}

	public function update_options( $old_value, $new_value ) {
		$publicationRepository = new PublicationRepository();
		$publicationRepository->setTransient();
	}

	public function options_page() { ?>
		<div class="wrap">
			<h1>u:cris Settings</h1>
			<form action="options.php" method="POST">
				<?php
				settings_fields( 'ucris_plugin' );
				do_settings_sections( 'ucris-publications-settings-page' );
				submit_button();
				?>
			</form>
		</div>
	<?php }

	function register_settings(): void {
		add_settings_section( 'ucris_section', null, null, 'ucris-publications-settings-page' );

		add_settings_field( 'ucris_api_key', 'API Key', array(
			$this,
			'api_key_html'
		), 'ucris-publications-settings-page', 'ucris_section' );
		register_setting( 'ucris_plugin', 'ucris_api_key', array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => ''
		) );


		add_settings_field( 'ucris_person_id', 'Person ID', array(
			$this,
			'person_id_html'
		), 'ucris-publications-settings-page', 'ucris_section' );
		register_setting( 'ucris_plugin', 'ucris_person_id', array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => ''
		) );
	}

	function api_key_html() { ?>
		<input type="text" name="ucris_api_key" value="<?php echo get_option( 'ucris_api_key' ); ?>"/>
	<?php }

	function person_id_html() { ?>
		<input type="text" name="ucris_person_id" value="<?php echo get_option( 'ucris_person_id' ); ?>"/>
	<?php }
}

?>
