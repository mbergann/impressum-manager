<?php

// workaround for visual tab not working, when loading on text editor
//add_filter('wp_default_editor', create_function('', 'return "tinymce";'));

?>

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
                    if(tinymce.editors[0] !== undefined)
                        tinymce.editors[0].setContent(response);
                });
            });
        });
    }(jQuery));
</script>

<?php

global $wpdb;

if (!empty($_POST) && isset($_POST['submit'])) {
    $val = html_entity_decode(nl2br(sanitize_text_field(@$_POST['editor'])));
    $key = sanitize_text_field(@$_POST['impressum_key']);
    $lang = sanitize_text_field(@$_POST['lang']);

    $table_name = $wpdb->prefix . "impressum_manager_content";

    $wpdb->update(
        $table_name,
        array(
            'impressum_value' => $val
        ),
        array(
            'lang' => $lang,
            'impressum_key' => $key
        ),
        array('%s'),
        array('%s', '%s')
    );
}

?>

<h3><?= __("Update Impressum Fields") ?></h3>
<form action="options-general.php?page=<?= SLUG ?>#fields-tab-j" method="post">
    <input type="hidden" class="hidden_impressum_manager_use_imported_impressum" name="impressum_manager_use_imported_impressum" value="">
    <select name="lang">
        <option>DE</option>
    </select>

    <select name="impressum_key" id="impressum_change">
        <?php
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
	<?php wp_editor("", "editor"); ?>
    </div>

    <?php submit_button(__("Update")) ?>
</form>
