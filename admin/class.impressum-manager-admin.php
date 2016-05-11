<?php

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class Impressum_Manager_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;
    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;

        add_action("admin_init", array($this, 'set_locale'));
    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * @since    1.0.0
     * @access   private
     */
    public static function set_locale()
    {
        load_plugin_textdomain(SLUG, false, dirname(plugin_basename(__FILE__)) . '/../languages');
    }

    /**
     * Used for the Filter for adding an extra field for
     * image post meta data. Adds an extra field for the
     * image source values.
     *
     * @since 1.0.0
     *
     * @param $form_fields
     * @param $post
     *
     * @return mixed
     */
    public static function field_credit($form_fields, $post)
    {
        // Fields for credentials which will be summed up in the impressum
        $form_fields['impressum-manager-image-credential'] = array(
            'label' => __('Urheber vom Bild'),
            'input' => 'text',
            'value' => get_post_meta($post->ID, 'impressum_manager_image_credential', true)
        );

        return $form_fields;
    }

    /**
     * Save method for the extra field in the image post meta data.
     *
     * @since 1.0.0
     *
     * @param $post
     * @param $attachment
     *
     * @return mixed
     */
    public static function field_credit_save($post, $attachment)
    {
        if (isset($attachment['impressum-manager-image-credential'])) {
            update_post_meta($post['ID'], 'impressum_manager_image_credential', $attachment['impressum-manager-image-credential']);
        }

        return $post;
    }

    /**
     * After installation a notice bar will be shown
     * to get into the onboarding of the impressum manager.
     * Will be dismissed once the onboarding was entered.
     *
     * @since 1.0.0
     */
    public static function installation_notice()
    {
        $request = $_SERVER['REQUEST_URI'];
        if (strpos($request, SLUG) !== false) {
            // indside impressum
        } else {
            if (get_option("impressum_manager_notice") === false && get_option("impressum_manager_name_company") === false) {
                $class = "error";
                $message = sprintf(__("Dein Wordpress Impressum ist nicht eingerichtet! %s, um deine Webseite rechtssicher zu machen."), "<a href='options-general.php?page=" . SLUG . "&step=1&&setup=true&dismiss=true'>Lege jetzt dein Impressum an</a>");
                echo "<div class=\"$class\"> <p>$message</p></div>";
            }
        }
    }

    /**
     * Callback for getting the values
     * for the editor. Loading the text values with
     * ajax call. So the text can be load async
     * into the wysiwyg editor.
     *
     * @since 1.0.0
     */
    public static function editor_ajax_callback()
    {
        $key = sanitize_text_field($_POST['key']);

        echo Impressum_Manager_Database::get_content($key);

        die();
    }

    /**
     * Saving Impressum Text into database via ajax
     *
     * @since 1.1.0
     */
    public static function save_editor_ajax_callback()
    {
        global $wpdb;

        $val = esc_sql($_POST['editor']);
        $key = sanitize_text_field($_POST['impressum_key']);
        $lang = sanitize_text_field($_POST['lang']);

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

        echo __("Saved Changes", SLUG);

        die();
    }

    public static function shortcode_preview_ajax_callback()
    {
        $shortcode = 'impressum_manager';
        add_shortcode($shortcode, array('Impressum_Manager_Shortcode_Manager', 'content_shortcode'));

        $shortcode = sanitize_text_field($_POST["shortcode_key"]);

        echo do_shortcode("[impressum_manager type='{$shortcode}']");
        die();
    }


    /**
     * Enqueue the styles.
     * Called by a hook.
     *
     * @since 1.0.0
     */
    public static function enqueue_style()
    {
        wp_enqueue_style('impressum_manager_style', plugins_url('css/impressum-manager.min.css', __FILE__));
    }

    /**
     * Enqueue the scrips.
     * Called by a hook.
     *
     * @since 1.0.0
     */
    public static function enqueue_script()
    {
        wp_enqueue_script('impressum_manager_script', plugins_url('js/impressum-manager.min.js', __FILE__));
        wp_enqueue_script('jquery');
        wp_enqueue_script('tiny_mce');
    }

    /**
     * Adding option page to the settings menu.
     * Called by a hook.
     *
     * @since 1.0.0
     */
    public static function add_menu()
    {
        $hook = add_options_page("Impressum Manager", 'Impressum Manager', 'manage_options', SLUG, array(
            'Impressum_Manager_Admin',
            'show'
        ), 99.5);
        add_action('load-' . $hook, array('Impressum_Manager_Admin', 'add_help_tab'));
    }

    /**
     * Adding the help tab on the upper right of the screen.
     * Contains all the helpful information for the plugin.
     *
     * @since 1.0.0
     */
    public static function add_help_tab()
    {
        $current_screen = get_current_screen();

        $help_shortcode_tab = array(
            'title' => __('Shortcodes', SLUG),
            'id' => 'shortcodes',
            'content' => '<p>' . __("Um das Impressum in einem Beitrag oder in einer Seite einzufügen, musst du einen Shortcode benutzen. Der Shortcode lautet:<br><br> <b>[impressum_manager]</b><br><br>Hierzu gibt es zusätzliche Parameter. Der Type Paramter erlaubt es dir Teilstücke vom Impressum wiederzugeben. Hierbei kannst du <ul><li>Datenschutz</li><li>Haftungsausschluss</li><li>Kontakt</li><li>Bildquellen</li></ul> verwenden. Dabei wird dein Shortcode folgendermaßen aussehen:<br><br><b>[impressum type=\"datenschutz\"]</b><br><br>", SLUG) . '</p>'
        );

        $help_settings_tab = array(
            'title' => __('Settings', SLUG),
            'id' => 'start_settings',
            'content' => '<p>' . __('Im Impressum Manager ist es möglich, Teile von dem Datenschutz bzw. Impressum Inhalte ein- und auszublenden. Mit den Häckchen in der Einestellungsseite kannst du die jeweiligen Bereiche ein- und ausschalten.', SLUG) . '</p>'
        );

        $help_feedback_tab = array(
            'title' => __('Feedback', SLUG),
            'id' => 'feedback',
            'content' => '<p>' . __('Schick deine Fragen und Feedback an: <a href="mailto:support@impressum-manager.com">support@impressum-manager.com</a>', SLUG) . '</p>'
        );

        $current_screen->add_help_tab(
            $help_shortcode_tab
        );

        $current_screen->add_help_tab(
            $help_settings_tab
        );

        $current_screen->add_help_tab(
            $help_feedback_tab
        );
        $current_screen->set_help_sidebar(
            '<p><strong>' . esc_html__('For more information:', SLUG) . '</strong></p>' .
            '<p><a href="http://www.impressum-manager.com/faq/" target="_blank">' . esc_html__('FAQ', SLUG) . '</a></p>' .
            '<p><a href="mailto:support@impressum-manager.com">' . esc_html__('Support', SLUG) . '</a></p>'

        );
    }

    /**
     * Returns the Page Url of the plugin section.
     *
     * @since 1.0.0
     *
     * @return string
     */
    public static function get_page_url()
    {
        return admin_url("options-general.php") . "?page=" . SLUG;
    }

    /**
     * Displaying the Admin Interface.
     *
     * @since 1.0.0
     */
    public static function show()
    {

        if (isset($_GET['view']) && $_GET['view'] == 'tutorial') {
            self::display_tutorial_page();
        } elseif (isset($_GET['view']) && $_GET['view'] == 'config') {
            include(plugin_dir_path(__FILE__) . "views/impressum-manager-config.php");
        } elseif (isset($_GET['view']) && $_GET['view'] == 'main') {
            include(plugin_dir_path(__FILE__) . "views/impressum-manager-main.php");
        } else {
            include(plugin_dir_path(__FILE__) . "views/impressum-manager-main.php");
        }

    }

    /**
     * Displaying the Tutorial Page
     *
     * @since 1.0.0
     */
    private static function display_tutorial_page()
    {

        switch (@$_GET['step']) {
            case 1:
                include(plugin_dir_path(__FILE__) . "views/tutorial/impressum-manager-tutorial-page1.php");
                break;

            case 2:

                if (array_key_exists("submit", $_REQUEST)) {
                    $db = Impressum_Manager_Database::getInstance();

                    $db->save_option("impressum_manager_person", sanitize_text_field(@$_POST["impressum_manager_person"]));
                    $db->save_option("impressum_manager_form_of_organization", sanitize_text_field(@$_POST["impressum_manager_form_of_organization"]));
                    $db->save_option("impressum_manager_name_company", sanitize_text_field(@$_POST["impressum_manager_name_company"]));
                    $db->save_option("impressum_manager_address", sanitize_text_field(@$_POST["impressum_manager_address"]));
                    $db->save_option("impressum_manager_address_extra", sanitize_text_field(@$_POST["impressum_manager_address_extra"]));
                    $db->save_option("impressum_manager_place", sanitize_text_field(@$_POST["impressum_manager_place"]));
                    $db->save_option("impressum_manager_zip", sanitize_text_field(@$_POST["impressum_manager_zip"]));
                    $db->save_option("impressum_manager_country", sanitize_text_field(@$_POST["impressum_manager_country"]));
                    $db->save_option("impressum_manager_fax", sanitize_text_field(@$_POST["impressum_manager_fax"]));
                    $db->save_option("impressum_manager_email", sanitize_text_field(@$_POST["impressum_manager_email"]));
                    $db->save_option("impressum_manager_phone", sanitize_text_field(@$_POST["impressum_manager_phone"]));
                    $db->save_option("impressum_manager_authorized_person", esc_textarea(@$_POST["impressum_manager_authorized_person"]));
                }

                include(plugin_dir_path(__FILE__) . "views/tutorial/impressum-manager-tutorial-page2.php");
                break;

            case 3:

                if (array_key_exists("submit", $_REQUEST)) {
                    $db = Impressum_Manager_Database::getInstance();

                    $db->save_option("impressum_manager_vat", sanitize_text_field(@$_POST["impressum_manager_vat"]));

                    $db->save_option("impressum_manager_register", sanitize_text_field(@$_POST["impressum_manager_register"]));
                    $db->save_option("impressum_manager_registenr", sanitize_text_field(@$_POST["impressum_manager_registenr"]));
                    $db->save_option("impressum_manager_register_court", sanitize_text_field(@$_POST["impressum_manager_register_court"]));

                    $db->save_option("impressum_manager_regulated_profession_checked", sanitize_text_field(@$_POST['impressum_manager_regulated_profession_checked']));
                    $db->save_option("impressum_manager_regulated_profession", sanitize_text_field(@$_POST["impressum_manager_regulated_profession"]));
                    $db->save_option("impressum_manager_state", sanitize_text_field(@$_POST["impressum_manager_state"]));
                    $db->save_option("impressum_manager_state_rules", sanitize_text_field(@$_POST["impressum_manager_state_rules"]));
                    $db->save_option("impressum_manager_chamber", sanitize_text_field(@$_POST["impressum_manager_chamber"]));
                    $db->save_option("impressum_manager_rules_link", sanitize_text_field(@$_POST["impressum_manager_rules_link"]));

                    $db->save_option("impressum_manager_responsible_persons", sanitize_text_field(@$_POST["impressum_manager_responsible_persons"]));

                    $db->save_option("impressum_manager_image_source", esc_textarea(@$_POST["impressum_manager_image_source"]));


                    $db->save_option("impressum_manager_press_content", sanitize_text_field(@$_POST["impressum_manager_press_content"]));

                    $db->save_option("impressum_manager_professional_liability_insurance_checked", sanitize_text_field(@$_POST["impressum_manager_professional_liability_insurance_checked"]));
                    $db->save_option("impressum_manager_name_and_adress", nl2br(sanitize_text_field(@$_POST["impressum_manager_name_and_adress"])));
                    $db->save_option("impressum_manager_space_of_appliance", sanitize_text_field(@$_POST['impressum_manager_space_of_appliance']));

                    $db->save_option("impressum_manager_surveillance_authority", sanitize_text_field(@$_POST['impressum_manager_surveillance_authority']));


                }

                include(plugin_dir_path(__FILE__) . "views/tutorial/impressum-manager-tutorial-page3.php");
                break;

            case 4:
                if (array_key_exists("submit", $_REQUEST)) {
                    $db = Impressum_Manager_Database::getInstance();

                    $db->save_option("impressum_manager_disclaimer", sanitize_text_field(@$_POST["impressum_manager_disclaimer"]));
                    $db->save_option("impressum_manager_general_privacy_policy", sanitize_text_field(@$_POST["impressum_manager_general_privacy_policy"]));
                    $db->save_option("impressum_manager_policy_facebook", sanitize_text_field(@$_POST["impressum_manager_policy_facebook"]));
                    $db->save_option("impressum_manager_policy_google_analytics", sanitize_text_field(@$_POST["impressum_manager_policy_google_analytics"]));
                    $db->save_option("impressum_manager_policy_google_adsense", sanitize_text_field(@$_POST["impressum_manager_policy_google_adsense"]));
                    $db->save_option("impressum_manager_policy_google_plus", sanitize_text_field(@$_POST["impressum_manager_policy_google_plus"]));
                    $db->save_option("impressum_manager_policy_twitter", sanitize_text_field(@$_POST["impressum_manager_policy_twitter"]));
                    $db->save_option("impressum_manager_extra_field", esc_textarea(@$_POST["impressum_manager_extra_field"]));

                }

                include(plugin_dir_path(__FILE__) . "views/tutorial/impressum-manager-tutorial-page4.php");
                break;


            default:
                self::show();
        }
    }

    /**
     * Registering all the settings for the options.
     * All the keys will be saved into the options table
     * in the database.
     *
     * @since 1.0.0
     */
    public function register_settings()
    {

        // general settings of the plugin
        register_setting("impressum-manager-general-settings", "impressum_manager_confirmation");

        // general options
        register_setting("impressum-manager-general-tab", "impressum_manager_noindex");
        register_setting("impressum-manager-general-tab", "impressum_manager_show_email_as_image");
        register_setting("impressum-manager-general-tab", "impressum_manager_powered_by");
        register_setting("impressum-manager-general-tab", "impressum_manager_source_from");

        // impressum - privacy policy options
        register_setting("impressum-manager-general-tab", "impressum_manager_disclaimer");
        register_setting("impressum-manager-general-tab", "impressum_manager_general_privacy_policy");
        register_setting("impressum-manager-general-tab", "impressum_manager_policy_facebook");
        register_setting("impressum-manager-general-tab", "impressum_manager_policy_google_analytics");
        register_setting("impressum-manager-general-tab", "impressum_manager_policy_google_adsense");
        register_setting("impressum-manager-general-tab", "impressum_manager_policy_twitter");
        register_setting("impressum-manager-general-tab", "impressum_manager_policy_google_plus");
        register_setting("impressum-manager-general-tab", "impressum_manager_disabled");
        register_setting("impressum-manager-general-tab", "impressum_manager_extra_field", "esc_textarea");

        // impressum general options
        register_setting("impressum-manager-settings", "impressum_manager_person");
        register_setting("impressum-manager-settings", "impressum_manager_form_of_organization");
        register_setting("impressum-manager-settings", "impressum_manager_name_company", array($this, "my_sanitize_method"));
        register_setting("impressum-manager-settings", "impressum_manager_address", array($this, "my_sanitize_method"));
        register_setting("impressum-manager-settings", "impressum_manager_address_extra", array($this, "my_sanitize_method"));
        register_setting("impressum-manager-settings", "impressum_manager_place", array($this, "my_sanitize_method"));
        register_setting("impressum-manager-settings", "impressum_manager_zip", array($this, "my_sanitize_method"));
        register_setting("impressum-manager-settings", "impressum_manager_country", array($this, "my_sanitize_method"));
        register_setting("impressum-manager-settings", "impressum_manager_fax", array($this, "my_sanitize_method"));
        register_setting("impressum-manager-settings", "impressum_manager_email", array($this, "my_sanitize_method"));
        register_setting("impressum-manager-settings", "impressum_manager_phone", array($this, "my_sanitize_method"));
        register_setting("impressum-manager-settings", "impressum_manager_authorized_person", "esc_textarea");
        register_setting("impressum-manager-settings", "impressum_manager_vat", array($this, "my_sanitize_method"));
        register_setting("impressum-manager-settings", "impressum_manager_register");
        register_setting("impressum-manager-settings", "impressum_manager_register_court", array($this, "my_sanitize_method"));
        register_setting("impressum-manager-settings", "impressum_manager_registenr", array($this, "my_sanitize_method"));
        register_setting("impressum-manager-settings", "impressum_manager_surveillance_authority", array($this, "my_sanitize_method"));
        register_setting("impressum-manager-settings", "impressum_manager_regulated_profession_checked");
        register_setting("impressum-manager-settings", "impressum_manager_regulated_profession", array($this, "my_sanitize_method"));
        register_setting("impressum-manager-settings", "impressum_manager_state", array($this, "my_sanitize_method"));
        register_setting("impressum-manager-settings", "impressum_manager_state_rules", array($this, "my_sanitize_method"));
        register_setting("impressum-manager-settings", "impressum_manager_chamber", array($this, "my_sanitize_method"));
        register_setting("impressum-manager-settings", "impressum_manager_rules_link", array($this, "my_sanitize_method"));
        register_setting("impressum-manager-settings", "impressum_manager_image_source", "esc_textarea");
        register_setting("impressum-manager-settings", "impressum_manager_responsible_persons", array($this, "my_sanitize_method"));
        register_setting("impressum-manager-settings", "impressum_manager_press_content", array($this, "my_sanitize_method"));
        register_setting("impressum-manager-settings", "impressum_manager_professional_liability_insurance_checked");
        register_setting("impressum-manager-settings", "impressum_manager_name_and_adress", array($this, "my_sanitize_method"));
        register_setting("impressum-manager-settings", "impressum_manager_space_of_appliance", array($this, "my_sanitize_method"));

        register_setting("impressum-manager-import-tab", "impressum_manager_imported_policy_url", array($this, "my_sanitize_method"));
        register_setting("impressum-manager-import-tab", "impressum_manager_imported_impressum_url", array($this, "my_sanitize_method"));
        register_setting("impressum-manager-import-tab", "impressum_manager_imported_agb_url", array($this, "my_sanitize_method"));
        register_setting("impressum-manager-import-tab", "impressum_manager_imported_disclaimer_url", array($this, "my_sanitize_method"));

        register_setting("impressum-manager-import-tab", "impressum_manager_use_imported_impressum");
        register_setting("impressum-manager-settings", "impressum_manager_use_imported_impressum");
        register_setting("impressum-manager-general-tab", "impressum_manager_use_imported_impressum");
    }

    /**
     * sanitize settings
     */
    public function my_sanitize_method($input)
    {
        return sanitize_text_field($input);
    }

}
