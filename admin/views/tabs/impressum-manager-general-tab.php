<?php
Impressum_Manager_Database::getInstance()->save_option( "impressum_manager_notice", "dismissed" );
?>

<form method="post" action="options.php">
	<?php
	settings_fields( 'impressum-manager-general-tab' );
	do_settings_sections( 'impressum-manager-general-tab' );
	?>
    <input type="hidden" class="hidden_impressum_manager_use_imported_impressum" name="impressum_manager_use_imported_impressum" value="">
	<table class="form-table" id="settings-options">
		<tbody>
		<?php Impressum_Manager_Form_Factory::get_impressum_config() ?>
		<?php Impressum_Manager_Form_Factory::get_source_from(); ?>
		<?php Impressum_Manager_Form_Factory::get_powered_by(); ?>
		<?php Impressum_Manager_Form_Factory::get_disclaimer(); ?>
		</tbody>
	</table>

	<?php submit_button( __( "Impressum aktualisieren", SLUG ) ); ?>
</form>
