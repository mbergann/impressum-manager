<script>
	(function ($) {
		$(document).ready(function () {
			$("#configure_impressum, #setup_existing, #skip_tutorial").click(function (event) {
				if (false === $("#willing_to").prop("checked")) {
					event.preventDefault();
					$("#willing_to").css("border", "2px #f00 solid");
					$("#willing_text").css("color", "#f00");
				} else {
					$("#willing_to").css("border", "inherit");
				}
			});

			$("#willing_to").click(function () {
				$(this).css("border", "inherit");
				$(this).parent().css("color", "inherit");
			});
		});
	}(jQuery));
</script>
<div class="wrap">
	<h2 class="logo"><?= __( 'Impressum Manager', SLUG ) ?></h2>

	<div class="impressum-manager-start-wrap">

		<h3><?= __( 'Willkommen bei Impressum-Manager. Dieses Plugin hilft dir deine Webseite(n) rechtsicher zu machen ...', SLUG ); ?></h3>

		<div class="box primary">
			<div class="box header"><?= __("Bestätigung des Warnhinweises",SLUG)?></div>

			<div class="box content"><?= __( 'Ich weiß, dass ich die Nutzung der Impressum, Datenschutz und Haftungsauschluss Inhalte ' .
			           'auf eigene Gefahr verwende. ' .
			           'Mir ist bewusst, dass Impressum Manager keine Gewährleistung auf Schadenersatz anbietet,' .
			           ' sofern rechtliche Schäden bzgl. meiner Webseite durch die Nutzung von dem Impressum Manager Wordpress Plugin entstanden sind. ', SLUG ); ?></div>
			<br>
			<p id="willing_text"><input type="checkbox" name="willing_to"
			                            id="willing_to"> <?= __( "Ich bestätige hiermit, dass ich das Plugin auf eigene Gefahr nutze.",SLUG ) ?>
			</p>

		</div>
		<div class="box primary">
			<div class="box header"><?= __( 'In 4 Schritten zur rechtssicheren Webseite', SLUG ); ?></div>
			<div class="box content"><?= __( 'Mit dem Impressum-Manager kannst du deine Webseite schnell rechtssicher machen, indem du ...', SLUG ); ?></div>
			<br>
			<form action="<?php Impressum_Manager_Admin::get_page_url() ?>" class="right">
				<input type="hidden" name="page" value="<?= SLUG ?>">
				<input type="hidden" name="view" value="tutorial"/>
				<input type="hidden" name="step" value="1"/>
				<input type="hidden" name="skip_start_temp" value="true">
				<input class="button button-primary" type="submit" id="configure_impressum"
				       value="<?= __( 'Impressum konfigurieren',SLUG ) ?>">
			</form>
		</div>
		<div class="box secondary">
			<div class="box header"><?= __( 'Später Konfigurieren', SLUG ); ?></div>
			<div class="box content"><?= __( 'Das Impressum lässt sich auch jederzeit später konfigureren. Wenn du erst die Einstellungen sehen möchstest, klicke hier auf den Button.', SLUG ); ?></div>
<br>
			<form action="<?php Impressum_Manager_Admin::get_page_url() ?>" class="right">
				<input type="hidden" name="page" value="<?= SLUG ?>">
				<input type="hidden" name="view" value="config">
				<input type="hidden" name="skip_start" value="true">
				<input type="hidden" name="tut_finished" value="true">
				<input class="button button-primary" type="submit" value="<?= __( 'Zu den Einstellungen', SLUG ) ?>"
				       id="skip_tutorial">
			</form>
		</div>

	</div>
