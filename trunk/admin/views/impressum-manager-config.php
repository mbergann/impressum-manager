<div class="wrap">
	<div style="float:right; position: relative; padding: 20px; margin-top: 30px; ">
		<a href="http://www.impressum-manager.com" target="_blank"><img
				src="<?= plugins_url( "images/impressum-manager-ad.png", dirname( __FILE__ ) ) ?>"></a>
	</div>
	<div class="box">
		<div class="box header"><h2><?= __( 'Konfiguriere dein Impressum.', SLUG ); ?></h2></div>
		<div class="box content"><p>
				<?= __( "Hier hast du die Möglichkeit mit einem Klick zu entscheiden, ob du dein importiertes Impressum nutzen möchtest, oder das generierte Impressum von Impressum Manager.", SLUG ); ?>
			</p>

			<p>
			<table>
				<tr>
					<th>
						<?= __( "Importiertes Impressum nutzen", SLUG ) ?>
					</th>
					<td>
						<label for="impressum_manager_use_imported_impressum">
							<input type="checkbox" id="impressum_manager_use_imported_impressum"
							       name="impressum_manager_use_imported_impressum" <?= checked( "on", get_option( "impressum_manager_use_imported_impressum" ), false ) ?>>
							<?= __( "Aktiviere das importierte Impressum anstatt das generierte Impressum", SLUG ); ?>
						</label>
					</td>
				</tr>
			</table>
			</p>
		</div>

		<div style="position: relative; float: right;">
			<form action="<?php Impressum_Manager_Admin::get_page_url() ?>">
				<input type="hidden" name="page" value="<?= SLUG ?>">
				<input type="hidden" name="view" value="main">
				<input class="button button-secondary" type="submit" value="<?= __( 'Zurück zur Vorschau', SLUG ) ?>">
			</form>
		</div>
		<h2 class="nav-tab-wrapper" id="impressum-manager-tabs">
			<a class="nav-tab nav-tab-active" id="general-tab"
			   href="#general-tab-j"><?= __( "General", SLUG ) ?></a>
			<a class="nav-tab" id="settings-tab"
			   href="#settings-tab-j"><?= __( "Kontaktdaten", SLUG ) ?></a>
			<a class="nav-tab" id="fields-tab"
			   href="#fields-tab-j"><?= __( "Impressum Fields", SLUG ) ?></a>
			<a class="nav-tab" id="import-tab"
			   href="#import-tab-j"><?= __( "Import" ) ?></a>
		</h2>
		<br>

		<div class="general-tab tab">
			<?php include( plugin_dir_path( __FILE__ ) . "/tabs/impressum-manager-general-tab.php" ) ?>
		</div>
		<div class="settings-tab tab">
			<?php include( plugin_dir_path( __FILE__ ) . "/tabs/impressum-manager-settings-tab.php" ) ?>
		</div>
		<div class="fields-tab tab">
			<?php include( plugin_dir_path( __FILE__ ) . "/tabs/impressum-manager-fields-tab.php" ) ?>
		</div>
		<div class="import-tab tab">
			<?php include( plugin_dir_path( __FILE__ ) . "/tabs/impressum-manager-import-tab.php" ) ?>
		</div>

	</div>

</div>
