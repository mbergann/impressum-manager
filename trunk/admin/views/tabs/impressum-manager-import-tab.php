<form method="post" action="options.php">
	<?php
	settings_fields( 'impressum-manager-import-tab' );
	do_settings_sections( 'impressum-manager-import-tab' );
	?>
    <input type="hidden" class="hidden_impressum_manager_use_imported_impressum" name="impressum_manager_use_imported_impressum" value="">
	<table class="form-table" id="settings-options">
		<tbody>
		<tr>
			<th>
				<?= __( "URL zum Impressum" , SLUG) ?>
			</th>
			<td>
				<input type="text" name="impressum_manager_imported_impressum_url"
				       value="<?= get_option( "impressum_manager_imported_impressum_url" ) ?>"
				       placeholder="http://www.">
			</td>
		</tr>
		<tr>
			<th>
				<?= __( "URL zum Datenschutz", SLUG ) ?>
			</th>
			<td>
				<input type="text" name="impressum_manager_imported_policy_url"
				       value="<?= get_option( "impressum_manager_imported_policy_url" ) ?>" placeholder="http://www.">
			</td>
		</tr>
		<tr>
			<th>
				<?= __( "URL zu den AGB", SLUG ) ?>
			</th>
			<td>
				<input type="text" name="impressum_manager_imported_agb_url"
				       value="<?= get_option( "impressum_manager_imported_agb_url" ) ?>" placeholder="http://www.">
			</td>
		</tr>
		<tr>
			<th>
				<?= __( "URL zum Disclaimer", SLUG ) ?>
			</th>
			<td>
				<input type="text" name="impressum_manager_imported_disclaimer_url"
				       value="<?= get_option( "impressum_manager_imported_disclaimer_url" ) ?>" placeholder="http://www.">
			</td>
		</tr>
		</tbody>
	</table>
	<?php submit_button( __( "Impressum aktualisieren", SLUG ) ); ?>
</form>