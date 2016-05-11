<script>
    (function ($) {
        $(document).ready(function () {
            $("#impressum_change").change(function () {
                var data = {
                    'action': 'impressum_manager_get_impressum_field',
                    key: $(this).val()
                };

                $.post(ajaxurl, data, function (response) {
                    $("#editor").val(response);
                    if (tinymce.editors[0] !== undefined)
                        tinymce.editors[0].setContent(response);
                });
            });

            $("#save-tinymce-submit input").click(function(e) {
                e.preventDefault();

                var config = {
                    action: 'impressum_manager_save_impressum_field',
                    'impressum_key': $("#impressum_change").val(),
                    lang: $("#lang").val(),
                    editor: tinymce.editors[0].getContent()
                }
                $.post(ajaxurl, config, function(response) {
                    $("#display_save_result").text(response).show().fadeOut();
                });
            });

        });
    }(jQuery));
</script>

<h3><?= __("Update Impressum Fields") ?></h3>
<input type="hidden" class="hidden_impressum_manager_use_imported_impressum"
       name="impressum_manager_use_imported_impressum" value="">
<select name="lang" id="lang">
    <option>DE</option>
</select>

<select name="impressum_key" id="impressum_change">
    <?php
    global $wpdb;

    $table_name = $wpdb->prefix . "impressum_manager_content";

    $lang_tags = $wpdb->get_results(
        "SELECT *
	FROM $table_name
	WHERE lang = 'DE'"
    );

    foreach ($lang_tags as $tag) {
        echo "<option value='" . $tag->impressum_key . "''>" . esc_html($tag->impressum_key) . "</option>";
    }
    ?>
</select>
<br><br>
<div style="max-width: 782px">
    <?php
    wp_editor("", "editor", array('default_post_edit_rows' => 10, 'tinymce' => array(
        'height' => 500
    ))); ?>
</div>

<p id="save-tinymce-submit">
    <input type="button" name="submit" id="submit" class="button button-primary" value="<?= __("Aktualisieren", SLUG) ?>">
</p>
<p id="display_save_result"></p>
