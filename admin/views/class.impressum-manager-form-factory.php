<?php

class Impressum_Manager_Form_Factory {

	// overall configs
	public static function get_powered_by() {

		echo '' ?>
		<tr>
			<th scope="row"><?= __( "Powered by Link", SLUG ) ?></th>
			<td>
				<label for="impressum_manager_powered_by">
					<input id="impressum_manager_powered_by" type="checkbox"
					       name="impressum_manager_powered_by"
						<?php
						if ( get_option( 'impressum_manager_powered_by' ) == true ) {
							echo "checked='checked'";
						} ?>>
					<?= __( "Blende den Powered By Link von Impressum Manager aus", SLUG ) ?>
				</label>
			</td>
		</tr>
	<?php
	}

public static function get_source_from() {
	echo '' ?>
	<tr>
		<th scope="row"><?= __( "eRecht24 Link", SLUG ) ?></th>
		<td>
			<label for="impressum_manager_source_from">
				<input id="impressum_manager_source_from" type="checkbox"
				       name="impressum_manager_source_from"

					<?php
					if ( get_option( 'impressum_manager_source_from' ) == true ) {
						echo "checked='checked'";
					} ?>>
				<?= __( "Blende den Link von eRecht24 aus. Vorsicht: Hierbei kann es zu rechtlichen Schäden führen.", SLUG ) ?>
			</label>
		</td>
	</tr>
	<tr>
		<?php
		}

		public static function get_impressum_config()
		{

		echo '' ?>
	<tr>
		<th scope="row"><?= __( "No Index", SLUG ) ?></th>
		<td>
			<label for="impressum_manager_noindex">
				<input id="impressum_manager_noindex" type="checkbox"
				       name="impressum_manager_noindex" <?= checked( "on", get_option( "impressum_manager_noindex" ), false ) ?>>
				<?= __( "Lass die Impressum Seite nicht von Suchmaschinen indexieren.", SLUG ) ?>
			</label>
		</td>
	</tr>
	<tr>
		<th scope="row"><?= __( "E-Mail als Bild", SLUG ) ?></th>
		<td>
			<label for="impressum_manager_show_email_as_image">
				<input id="impressum_manager_show_email_as_image" type="checkbox"
				       name="impressum_manager_show_email_as_image" <?= checked( "on", get_option( "impressum_manager_show_email_as_image" ), false ) ?>>
				<?= __( "Zeige E-Mail als Bild um Spam zu vermeiden", SLUG ) ?>
			</label>
		</td>
	</tr>
	<tr>
		<?php
		}

		public static function get_disclaimer()
		{
		echo '' ?>


	<tr>
		<th colspan="2"><h2><?= __( "Impressum Inhalt Einstellungen", SLUG ) ?></h2></th>
	</tr>
	<tr>
		<th>
			<?= __( "Haftungsausschluss (Disclaimer)", SLUG ) ?>
		</th>
		<td>
			<label for="impressum_manager_disclaimer">
				<input id="impressum_manager_disclaimer" type="checkbox"
				       name="impressum_manager_disclaimer" <?= checked( "on", get_option( "impressum_manager_disclaimer" ), false ) ?>>
				<?= __( "Füge einen Disclaimer in dein Impressum ein.", SLUG ) ?>
			</label>
		</td>
	</tr>
	<tr>
		<th>
			<?= __( "Allgemine Datenschutzerklärung", SLUG ) ?>
		</th>
		<td>
			<label for="impressum_manager_general_privacy_policy">
				<input id="impressum_manager_general_privacy_policy" type="checkbox"
				       name="impressum_manager_general_privacy_policy" <?= checked( "on", get_option( "impressum_manager_general_privacy_policy" ), false ) ?>>
				<?= __( "Füge eine allgemeine Datenschutzerklärung in dein Impressum ein.", SLUG ) ?>
			</label>
		</td>
	</tr>
	<tr>
		<th>
			<?= __( "Datenschutzerklärung für Facebook", SLUG ) ?>
		</th>
		<td>
			<label for="impressum_manager_policy_facebook">
				<input id="impressum_manager_policy_facebook" type="checkbox"
				       name="impressum_manager_policy_facebook" <?= checked( "on", get_option( "impressum_manager_policy_facebook" ), false ) ?>>
				<?= __( "Füge eine Datenschutzerklärung für die Nutzung von Facebook Elementen in dein Impressum ein.", SLUG ) ?>
			</label>
		</td>
	</tr>
	<tr>
		<th>
			<?= __( "Datenschutzerklärung für Google", SLUG ) ?>
		</th>
		<td>
			<label for="impressum_manager_policy_google_analytics">
				<input id="impressum_manager_policy_google_analytics" type="checkbox"
				       name="impressum_manager_policy_google_analytics" <?= checked( "on", get_option( "impressum_manager_policy_google_analytics" ), false ) ?>>
				<?= __( "Füge eine Datenschutzerklärung für die Nutzung von <b>Google Analytics</b> in dein Impressum ein.", SLUG ) ?>
			</label>
			<br><br>
			<label for="impressum_manager_policy_google_adsense">
				<input id="impressum_manager_policy_google_adsense" type="checkbox"
				       name="impressum_manager_policy_google_adsense" <?= checked( "on", get_option( "impressum_manager_policy_google_adsense" ), false ) ?>>
				<?= __( "Füge eine Datenschutzerklärung für die Nutzung von <b>Google Adsense</b> in dein Impressum ein.", SLUG ) ?>
			</label>
			<br><br>
			<label for="impressum_manager_policy_google_plus">
				<input id="impressum_manager_policy_google_plus" type="checkbox"
				       name="impressum_manager_policy_google_plus" <?= checked( "on", get_option( "impressum_manager_policy_google_plus" ), false ) ?>>
				<?= __( "Füge eine Datenschutzerklärung für die Nutzung von <b>Google +1</b> in dein Impressum ein.", SLUG ) ?>
			</label>
		</td>
	</tr>
	<tr>
		<th>
			<?= __( "Datenschutzerklärung für Twitter", SLUG ) ?>
		</th>
		<td>
			<label for="impressum_manager_policy_twitter">
				<input id="impressum_manager_policy_twitter" type="checkbox"
				       name="impressum_manager_policy_twitter" <?= checked( "on", get_option( "impressum_manager_policy_twitter" ), false ) ?>>
				<?= __( "Füge eine Datenschutzerklärung für die Nutzung von Twitter Elementen in dein Impressum ein.", SLUG ) ?>
			</label>
		</td>
	</tr>
	<tr>
		<th>
			<?= __( "Zusatzfeld", SLUG ) ?>
		</th>
		<td>
                <textarea
	                name="impressum_manager_extra_field"><?= get_option( "impressum_manager_extra_field" ) ?></textarea>
		</td>
	</tr>


<?php
}

	// settings

	public static function get_person_type() {
		echo '' ?>


		<script>
			(function ($) {
				$(document).ready(function () {
					$("#person_1").click(function () {
						$(".rechtsform").fadeOut();
						$("#full_name").text("<?=__("Vollständiger Name")?>");
					});
					$("#person_2").click(function () {
						$(".rechtsform").fadeIn();
						$("#full_name").text("<?=__("Firmenname inkl. Rechtsform")?>");
					})
				});
			}(jQuery));
		</script>

		<tr valign="top">
			<th scope="row"><b><?= __( 'Art der Person', SLUG )?>
			</th>
			<td>
				<label>
					<input type="radio" id="person_1" name="impressum_manager_person"
					       value="1" <?php
					if ( get_option( 'impressum_manager_person' ) == 1 ) {
						echo "checked=checked";
					} ?>>
					<?= __( "Privatperson", SLUG ) ?>
				</label>
				<br>
				<label>
					<input type="radio" id="person_2" name="impressum_manager_person"
					       value="2" <?php
					if ( get_option( 'impressum_manager_person' ) == 2 ) {
						echo "checked=checked";
					} ?>>
					<?= __( "Juristische Person (z.B. Firma, Verein, Organisation, Einrichtung)", SLUG ) ?>
				</label>

			</td>
		</tr>

	<?php
	}

	public static function get_legal_form() {
		echo '' ?>
		<tr valign="top" class="rechtsform">
			<th scope="row"><b><?= __( "Rechtsform", SLUG ) ?></b></th>
			<td>
				<select name="impressum_manager_form_of_organization">
					<?php
					$forms_of_organization = array(
						__( "Einzelunternehmen", SLUG ),
						__( "Stille Gesellschaft", SLUG ),
						__( "Offene Handelsgesellschaft (OHG)", SLUG ),
						__( "Kommanditgesellschaft (KG)", SLUG ),
						__( "Gesellschaft bürgerlichen Rechts (GdR)", SLUG ),
						__( "Aktiengesellschaft (AG)", SLUG ),
						__( "Kommanditgesellschaft auf Aktien (KGaA)", SLUG ),
						__( "Gesellschaft mit beschränkter Haftung (GmbH)", SLUG ),
						__( "Genossenschaft (eG)", SLUG ),
                        __( "Eingetragener Verein (e.V.)", SLUG )
					);

					$idx = 1;
					foreach ( $forms_of_organization as $org_form ) {
						?>
						<option value="<?= $idx ?>" <?php
						if ( $idx == get_option( "impressum_manager_form_of_organization" ) ) {
							echo "selected=selected";
						}
						?>><?= $org_form ?></option>
						<?php
						$idx ++;
					}
					?>
				</select>
			</td>
		</tr>
	<?php
	}

	public static function get_organisation() {
		echo '' ?>

		<tr valign="top">
			<th scope="row"><b><?= __( "Angaben zur Organisation", SLUG ) ?></b></th>
			<td>

				<input type="text" name="impressum_manager_name_company"
				       title="Company Name" placeholder="Muster AG"
				       value="<?= get_option( "impressum_manager_name_company" ) ?>">
				<br>
				<small id="full_name"><?= __( "Vollständiger Name", SLUG ) ?></small>
				<br>
				<input type="text" name="impressum_manager_address" title="Address"
                       placeholder="Musterstraße 111"
				       value="<?= get_option( "impressum_manager_address" ) ?>">
				<br>
				<small><?= __( "Straße & Hausnummer", SLUG ) ?></small>
				<br>
				<input type="text" name="impressum_manager_address_extra" title="Address Extra"
                       placeholder="Gebäude 44"
				       value="<?= get_option( "impressum_manager_address_extra" ) ?>"><br>
				<small><?= __( "Adresszusatz", SLUG ) ?></small>
				<br>
				<input type="text" name="impressum_manager_place"
				       title="Place" placeholder="Musterstadt"
				       value="<?= get_option( "impressum_manager_place" ) ?>"><br>
				<small><?= __( "Ort", SLUG ) ?></small>
				<br>
				<input type="text" name="impressum_manager_zip"
				       title="ZIP Code" placeholder="90210"
				       value="<?= get_option( "impressum_manager_zip" ) ?>"><br>
                <small><?= __("PLZ", SLUG) ?></small>
                <br>
                <input type="text" name="impressum_manager_country" title="Country"
                       placeholder="Deutschland"
                       value="<?= get_option("impressum_manager_country") ?>">
                <br>
                <small><?= __("Land", SLUG) ?></small>
            </td>
		</tr>

	<?php
	}

	public static function get_professional_liability_insurance() {

		echo "" ?>

		<script>
			(function ($) {
				$(document).ready(function () {
					$(".hide_professional_liability_insurance").hide();

					if ($("#professional_liability_insurance").attr("checked") == true || $("#professional_liability_insurance").attr("checked") == "checked") {
						$(".hide_professional_liability_insurance").show();
					}

					$("#professional_liability_insurance").click(function () {
						if ($(this).attr("checked")) {
							$(".hide_professional_liability_insurance").show();
						} else {
							$(".hide_professional_liability_insurance").hide();
						}
					});
				});
			}(jQuery));
		</script>

		<tr valign="top">
			<th scope="row"><input type="checkbox" id="professional_liability_insurance"
			                       name="impressum_manager_professional_liability_insurance_checked" <?= checked( "on", get_option( "impressum_manager_professional_liability_insurance_checked" ), false ) ?>><label
					for="professional_liability_insurance"><b><?= __( "Berufshaftpflichtversicherung", SLUG ) ?></b></label>
			</th>
			<td class="hide_professional_liability_insurance">
                <textarea name="impressum_manager_name_and_adress"
                          title="Beispiel Versicherung AG
Musterweg 10
90210 Musterstadt"
	                ><?= get_option( "impressum_manager_name_and_adress" ) ?></textarea>
				<br>
				<small><?= __( "Name und Anschrift", SLUG ) ?>
				</small>
				<br>
				<input type="text" name="impressum_manager_space_of_appliance" title="State"
                       placeholder="Deutschland"
				       value="<?= get_option( "impressum_manager_space_of_appliance" ) ?>">
				<br>
				<small><?= __( "Geltungsraum", SLUG ) ?></small>
				<br>
			</td>
		</tr> <?php
	}

	public static function get_telephone() {
		echo '' ?>
		<tr>
			<th>
				<b><?= __( "Telefonnummer (inkl. Vorwahl)", SLUG ) ?></b>
			</th>
			<td>
				<input type="tel" name="impressum_manager_phone" title="Phone Number"
                       placeholder="+49 (0) 123 44 55 66"
				       value="<?= get_option( "impressum_manager_phone" ) ?>">
			</td>
		</tr>
	<?php
	}

	public static function get_fax() {
		echo '' ?>
		<tr>
			<th>
				<b><?= __( "Faxnummer (optional)", SLUG ) ?></b>
			</th>
			<td>
				<input type="text" name="impressum_manager_fax" title="Fax Number"
                       placeholder="+49 (0) 123 44 55 99"
				       value="<?= get_option( "impressum_manager_fax" ) ?>">
			</td>
		</tr>
	<?php
	}

	public static function get_email() {
		echo '' ?>
		<tr>
			<th>
				<b><?= __( "E-Mail Adresse", SLUG ) ?></b>
			</th>
			<td>
				<input type="email" name="impressum_manager_email" title="E-Mail Address"
                       placeholder="mustermann@musterfirma.de"
				       value="<?= get_option( "impressum_manager_email" ) ?>">
			</td>
		</tr>
	<?php
	}

	public static function get_authorized_persons() {

		echo '' ?>

		<tr valign="top">
			<th scope="row"><b><?= __( "Vertretungsberechtigte Persone(n)", SLUG ) ?></b>
			</th>
			<td>
                <textarea name="impressum_manager_authorized_person"
                          title="Herr Dr. Harry Mustermann
Frau Luise Beispiel"
	                ><?= get_option( "impressum_manager_authorized_person" ) ?></textarea><br>
				<small><?= __( "Namen und Vornamen", SLUG ) ?></small>
			</td>
		</tr>

	<?php
	}

	public static function get_vat() {

		echo '' ?>

		<tr valign="top">
			<th scope="row"><b><?= __( "Umsatzsteuer ID", SLUG ) ?></b></th>
			<td>
				<input type="text" name="impressum_manager_vat" title="VAT"
                       placeholder="DE 999 999 999"
				       value="<?= get_option( "impressum_manager_vat" ) ?>">
			</td>
		</tr>

	<?php
	}

	public static function get_register() {

		?>

		<script>
			(function ($) {
				$(document).ready(function () {
					triggerShowOfRegisterStuff();

					$("#impressum_manager_register").change(function () {
						triggerShowOfRegisterStuff();
					});

					function triggerShowOfRegisterStuff() {
						if (1 == $("#impressum_manager_register").val()) {
							$(".hide_register").hide();
						} else {
							$(".hide_register").show();
						}
					}
				});
			}(jQuery));
		</script>

		<tr valign="top">
			<th scope="row"><b><?= __( "Register", SLUG ) ?></b></th>
			<td>
				<select name="impressum_manager_register" id="impressum_manager_register">
					<?php
					$registerDescr = array(
						__( "Kein Register", SLUG ),
						__( "Genossenschaftsregister", SLUG ),
						__( "Handelsregister", SLUG ),
						__( "Partnerschaftsregister", SLUG ),
						__( "Vereinsregister", SLUG )
					);

					$idx = 1;

					echo get_option( "impressum_manager_register" );

					foreach ( $registerDescr as $registerName ) {
						if ( get_option( "impressum_manager_register" ) == $idx ) {
							$selected = "selected=selected";
						} else {
							$selected = "";
						}
						?>
						<option value="<?= $idx ?>" <?= $selected ?>><?= $registerName ?></option>
						<?php
						$idx ++;
					}

					?>
				</select>
			</td>
		</tr>
		<tr valign="top" class="hide_register">
			<th scope="row"><b><?= __( "Registergericht", SLUG ) ?></b></th>
			<td>
				<input type="text" name="impressum_manager_register_court" title="Registergericht"

				       value="<?= get_option( "impressum_manager_register_court" ) ?>">
			</td>
		</tr>
		<tr valign="top" class="hide_register">
			<th scope="row"><b><?= __( "Registernummer", SLUG ) ?></b></th>
			<td>
				<input type="text" name="impressum_manager_registenr" title="Registernummer"

				       value="<?= get_option( "impressum_manager_registenr" ) ?>">
			</td>
		</tr>
	<?php
	}

	public static function get_surveillance_authority() {
		?>

		<tr valign="top">
			<th scope="row"><b><?= __( "Aufsichtsbehörde ", SLUG ) ?></b></th>
			<td>
				<input type="text" name="impressum_manager_surveillance_authority" title="surveillance_authority"
                       placeholder="Landratsamt Musterstadt"
				       value="<?= get_option( "impressum_manager_surveillance_authority" ) ?>">
			</td>
		</tr>


	<?php
	}

	public static function get_regulated_profession() {

		?>

		<script>
			(function ($) {
				$(document).ready(function () {
					$(".hide_regulated_profession").hide();

					if ($("#regulated_profession").attr("checked") == true || $("#regulated_profession").attr("checked") == "checked") {
						$(".hide_regulated_profession").show();
					}

					$("#regulated_profession").click(function () {
						if ($(this).attr("checked")) {
							$(".hide_regulated_profession").show();
						} else {
							$(".hide_regulated_profession").hide();
						}
					});
				});
			}(jQuery));
		</script>

		<tr valign="top">
			<th scope="row"><input type="checkbox" id="regulated_profession"
			                       name="impressum_manager_regulated_profession_checked" <?= checked( "on", get_option( "impressum_manager_regulated_profession_checked" ), false ) ?>><label
					for="regulated_profession"><b><?= __( "Reglementierter Beruf", SLUG ) ?></b></label>
			</th>
			<td class="hide_regulated_profession">

				<input type="text" name="impressum_manager_regulated_profession"
				       title="Regulated profession"

				       value="<?= get_option( "impressum_manager_regulated_profession" ) ?>">
				<br>
				<small><?= __( "Gesetzliche Berufsbezeichnung", SLUG ) ?></small>
				<br>
				<input type="text" name="impressum_manager_state" title="State"
				       value="<?= get_option( "impressum_manager_state" ) ?>">
				<br>
				<small><?= __( "Staat, in dem die Berufsbezeichnung verliehen wurde", SLUG ) ?></small>
				<br>
				<input type="text" name="impressum_manager_state_rules" title="State rules"

				       value="<?= get_option( "impressum_manager_state_rules" ) ?>">
				<br>
				<small><?= __( "Berfusrechtliche Regelungen (Bezeichnung)", SLUG ) ?></small>
				<br>
				<input type="text" name="impressum_manager_chamber" title="Chamber"
				       value="<?= get_option( "impressum_manager_chamber" ) ?>">
				<br>
				<small><?= __( "Kammer, der Sie angehören", SLUG ) ?></small>
				<br>
				<input type="url" name="impressum_manager_rules_link" title="Ruleslink"
				       value="<?= get_option( "impressum_manager_rules_link" ) ?>" placeholder="http://www.">
				<br>
				<small><?= __( "URL zu gesetzl. Regelungen", SLUG ) ?></small>
			</td>
		</tr>

	<?php
	}

	public static function get_image_sources() {

		?>

		<tr valign="top">
			<th scope="row"><b><?= __( "Bildquellen", SLUG ) ?></b></th>
			<td>
                <textarea name="impressum_manager_image_source"
                          title="http://www.bildagentur-sonnenschein.de
Kuno Knipser

http://www.onlineagentur-pusemuckel.de
Benno Blitzer
Peggy Picture"
	                ><?= get_option( "impressum_manager_image_source" ) ?></textarea><br>
				<small><?= __( "z.B. Max Mustermann, http://www.fotolia.com", SLUG ) ?></small>
			</td>
		</tr>

	<?php
	}

	public static function get_responsible_persons() {

		echo '' ?>

		<script>
			(function ($) {
				$(document).ready(function () {
					$("#press_content_textarea").hide();

					if ($("#press_content").attr("checked") == true || $("#press_content").attr("checked") == "checked") {
						$("#press_content_textarea").show();
					}

					$("#press_content").click(function () {
						if ($(this).attr("checked")) {
							$("#press_content_textarea").show();
						} else {
							$("#press_content_textarea").hide();
						}
					});

				});
			}(jQuery));
		</script>


		<tr valign="top">
			<th scope="row"><input type="checkbox" id="press_content"
			                       name="impressum_manager_press_content"  <?= checked( "on", get_option( "impressum_manager_press_content" ), false ) ?>
				<label
					for="press_content"><b><?= __( "journalistisch-redaktionelle Inhalte", SLUG ) ?></b></label>
			</th>
			<td id="press_content_textarea">
                <textarea name="impressum_manager_responsible_persons"
                          title="Beate Beispielhaft
&#10;
Musterstraße 110
Gebäude 33
90210 Musterstadt"
	                ><?= get_option( "impressum_manager_responsible_persons" ) ?></textarea><br>
				<small><?= __( "Vor-, Nachname inkl. Anschrift angeben. Bei mehreren Verantwortlichen die
                                        Verantwortungen entsprechend mit angeben.", SLUG ) ?>
				</small>
			</td>
		</tr>

	<?php
	}


}

