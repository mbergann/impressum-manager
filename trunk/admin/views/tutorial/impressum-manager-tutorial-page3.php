<div class="wrap">
	<h2 class="logo"><?= __( 'Impressum Manager', SLUG ) ?></h2>

	<div class="box primary">
		<div class="box header">

			<span style="float:left;position:relative;padding:5px"><?= __( "Schritt 3/4", SLUG ) ?></span>

			<form action="<?php Impressum_Manager_Admin::get_page_url() ?>#general-tab">
				<input type="hidden" name="page" value="<?= SLUG ?>">
				<input type="hidden" name="view" value="start"/>
				<input class="button button-secondary" style="float:right;position:relative" type="submit"
				       id="configure_impressum"
				       value="<?= __( 'Abbrechen',SLUG ) ?>">
			</form>
		</div>
		<br>
		<hr>
		<p>
		<div class="box content">
			<form action="<?= Impressum_Manager_Admin::get_page_url() ?>&view=tutorial&skip_start_temp=true&step=4"
			      method="post">
				<table class="form-table" id="settings-options">
					<tbody>
					<?php Impressum_Manager_Form_Factory::get_disclaimer() ?>
					</tbody>
				</table>
		</p>
		<hr>
		<table>
			<tr>
				<td>
					<a href="options-general.php?page=<?= SLUG ?>&view=tutorial&skip_start_temp=true&step=2">
						<input type="button" class="button button-secondary"
						       value="<?= __( "Schritt zurück", SLUG ) ?>"
						       style="margin-top: 5px">
					</a>
				</td>
				<td>
					<?= submit_button( __( "Nächster Schritt", SLUG ) ) ?>
				</td>
			</tr>
		</table>
		</form>
	</div>
</div>
</div>