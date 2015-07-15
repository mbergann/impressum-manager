<?php

Impressum_Manager_Admin::save_option( "impressum_manager_notice", "dismissed" );

if ( @$_GET['tut_finished'] == true && array_key_exists( "submit", $_REQUEST ) ) {
	Impressum_Manager_Admin::save_option( "impressum_manager_noindex", @sanitize_text_field($_POST['impressum_manager_noindex']) );
	Impressum_Manager_Admin::save_option( "impressum_manager_show_email_as_image", @sanitize_text_field($_POST['impressum_manager_show_email_as_image']) );
}

?>
<div class="wrap">
	<h2 class="logo"><?= __( 'Impressum Manager', SLUG ) ?></h2>

	<?php

	$impressum = Impressum_Manager_Impressum_Manager::getInstance()->get_impressum();

	if ( ! $impressum->has_content() ) {
		?>
		<div class="box primary" style="text-align: center">
			<div class="box header"><?= __( "Dein Impressum ist leer!", SLUG ) ?></div>
			<br>

			<div
				class="box content"><?= __( "Wähle eine der Optionen aus, um dein Impressum zu erstellen.", SLUG ) ?></div>
			<br>

			<div class="box content">
				<p>

				<form action=<?php Impressum_Manager_Admin::get_page_url() ?>>
					<input type="hidden" name="page" value="<?= SLUG ?>">
					<input type="hidden" name="view" value="tutorial"/>
					<input type="hidden" name="step" value="1"/>
					<input class="button button-primary" type="submit" id="configure_impressum"
					       value="<?= __( 'Impressum generieren',SLUG ) ?>">
				</form>
				<br>
				<?= __( 'oder', SLUG ) ?>
				<br>
				<br>
				<form action="<?php Impressum_Manager_Admin::get_page_url() ?>#import-tab">
					<input type="hidden" name="page" value="<?= SLUG ?>">
					<input type="hidden" name="view" value="config"/>
					<input class="button button-primary" type="submit" id="configure_impressum"
					       value="<?= __( 'Impressum importieren',SLUG ) ?>">
				</form>
				</p>
			</div>
		</div>
		<br>
		<div style="text-align: center">
			<p><?= __( 'Alternativ kannst du auch direkt zu den', SLUG ) ?></p>
			<form action="<?php Impressum_Manager_Admin::get_page_url() ?>#general-tab">
				<input type="hidden" name="page" value="<?= SLUG ?>">
				<input type="hidden" name="view" value="config"/>
				<input class="button button-secondary" type="submit" id="configure_impressum"
				       value="<?= __('Einstellungen',SLUG ) ?>">
			</form>
		</div>
	<?php
	} else {
	?>
		<script>
			(function ($) {
				$(document).ready(function () {
					$("#impressum_shortcode_preview").change(function () {
						var data = {
							'action': 'impressum_manager_get_shortcode_preview',
							'shortcode_key': $(this).val()
						};

						$.post(ajaxurl, data, function (data) {
							$("#impressum-preview-content").html(data);
						});
					});
				})
			}(jQuery));
		</script>
		<div class="box primary">
			<form action="<?php Impressum_Manager_Admin::get_page_url() ?>" class="right" style="display:inline">
				<input type="hidden" name="page" value="<?= SLUG ?>">
				<input type="hidden" name="view" value="config">
				<input class="button button-primary" type="submit" value="<?= __( 'Konfigurieren',SLUG ) ?>">
			</form>
			<div class="box header"
			     style="display:inline"><?= __( 'Wähle einen shortcode aus und schau dir die Vorschau an! ', SLUG ); ?></div>
			<br><br>


			<?= __( 'Shortcode: ', SLUG ) ?>

			<select name="impressum_shortcode_preview" id="impressum_shortcode_preview" style="display:inline">
				<?php

				$components = $impressum->get_components();
				foreach ( $components as $component ) {
					if ( $component->has_content() ) {
						$shortcode = $component->get_shortcode();
						$name      = $component->get_name();
						echo "<option value=$shortcode>$name</option>";
					}
				}

				?>
			</select>

			<hr>
			<div id="impressum-preview-content">
				<?php
				echo $impressum->draw();
				?>
			</div>
		</div>
	<?php
	}
	?>
</div>

<?php

