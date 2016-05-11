<?php

defined('ABSPATH') or die('No script kiddies please!');

define('DISCLAIMER', 'disclaimer');
define('POLICY_HEADER', 'policy_header');
define('POLICY_GENERAL', 'policy_general');
define('POLICY_FACEBOOK', 'policy_facebook');
define('POLICY_ANALYTICS', 'policy_analytics');
define('POLICY_ADSENSE', 'policy_adsense');
define('POLICY_GOOGLE_PLUS', 'policy_google_plus');
define('POLICY_TWITTER', 'policy_twitter');
define('POLICY_END', 'policy_end');

class Impressum_Manager_Impressum_Factory
{

    public static function create_generated_impressum()
    {

        $all = new Impressum_Manager_Impressum('', '[impressum_manager]');

        $impressum = new Impressum_Manager_Impressum('impressum', '- [impressum_manager type="impressum"]');

        $impressum->add(new Impressum_Manager_Text(__("<h2>Angaben gemäß § 5 TMG:</h2>", SLUG)));

        $impressum->add(new Impressum_Manager_Textunit('address', '- - [impressum_manager type="address"]', self::get_address()));

        $impressum->add(new Impressum_Manager_Textunit('authorized_person', '- - [impressum_manager type="authorized_person"]', self::get_authorized_person()));

        $impressum->add(new Impressum_Manager_Textunit('contact', '- - [impressum_manager type="contact"]', self::get_contact()));

        $impressum->add(new Impressum_Manager_Textunit('register', '- - [impressum_manager type="register"]', self::get_register()));

        $impressum->add(new Impressum_Manager_Textunit('vat', '- - [impressum_manager type="vat"]', self::get_vat()));

        $impressum->add(new Impressum_Manager_Textunit('regulatory_authority', '- - [impressum_manager type="regulatory_authority"]', self::get_regulatory_authority()));

        $impressum->add(new Impressum_Manager_Textunit('professional_liability_insurance', '- - [impressum_manager type="professional_liability_insurance"]', self::get_professional_liability_insurance()));

        $impressum->add(new Impressum_Manager_Textunit('responsible_person', '- - [impressum_manager type="responsible_person"]', self::get_responsible_person()));

        $impressum->add(new Impressum_Manager_Textunit('image_sources', '- - [impressum_manager type="image_sources"]', self::get_image_sources()));

        $impressum->add(new Impressum_Manager_Textunit('extra_field', '- - [impressum_manager type="extra_field"]', self::get_extra_field()));


        $privacy_policy_and_disclaimer = new Impressum_Manager_Impressum('privacy_policy_and_disclaimer', '- [impressum_manager type="privacy_policy_and_disclaimer"]');

        $privacy_policy_and_disclaimer->add(new Impressum_Manager_Textunit('disclaimer', '- - [impressum_manager type="disclaimer"]', self::get_disclaimer()));

        $privacy_policy_and_disclaimer->add(new Impressum_Manager_Textunit('privacy_policy', '- - [impressum_manager type="privacy_policy"]', self::get_privacy_policy()));


        $all->add($impressum);

        $all->add($privacy_policy_and_disclaimer);

        return $all;

    }

    public static function create_imported_impressum()
    {

        $impressum_text = "";
        $policy = "";
        $agb = "";
        $disclaimer = "";

        @$impressum_text = file_get_contents(get_option("impressum_manager_imported_impressum_url"));
        @$policy = file_get_contents(get_option("impressum_manager_imported_policy_url"));
        @$agb = file_get_contents(get_option("impressum_manager_imported_agb_url"));
        @$disclaimer = file_get_contents(get_option("impressum_manager_imported_disclaimer_url"));

        $impressum = new Impressum_Manager_Impressum('', '[impressum_manager]');

        $impressum->add(new Impressum_Manager_Textunit('imported_impressum', "imported impressum", $impressum_text));

        $impressum->add(new Impressum_Manager_Textunit('policy', "policy", $policy));

        $impressum->add(new Impressum_Manager_Textunit('agb', "agb", $agb));

        $impressum->add(new Impressum_Manager_Textunit('disclaimer', "disclaimer", $disclaimer));

        return $impressum;
    }


    /**
     *************************
     * INTERN IMPRESSUM CALLS
     *************************
     */


    /**
     * get_address returns the whole address string, which admin the company or name,
     * the address itself with the address extra and the place and zip of the company
     * or person.
     *
     * @since 1.0.0
     *
     * @return string
     */
    private static function get_address()
    {

        $result = "";

        $form = get_option("impressum_manager_form_of_organization");
		$name = get_option("impressum_manager_name_company");
		$address = get_option("impressum_manager_address");
		$address_extra = get_option("impressum_manager_address_extra");
        $place  = get_option("impressum_manager_place");
        $zip = get_option("impressum_manager_zip");
        $country = get_option("impressum_manager_country");

        if(get_option("impressum_manager_person") == 2) {

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

            $result = __("Rechtsform") . ": " . $forms_of_organization[$form - 1] . "<br>";
        }

		if (!empty($name)) {
            $result .= $name . "<br>";
        }
		if (!empty($address)) {
            $result .= $address . "<br>";
        }
		if (!empty($address_extra)) {
            $result .= $address_extra . "<br>";
        }
		if (!empty($zip)) {
            $result .= $zip . " ";
        }
		if (!empty($place)) {
            $result .= $place;
        }
        if (!empty($country)) {
            $result .= "<br>" . $country;
        }

		if (strlen($result) > 0) {
            $result = "<p>" . $result . "</p>";
        }

		return $result;
	}

    /**
     * get_contact will return the full contact string which admin the phone, fax and email.
     * E-Mail will be either shown as string or image. This option can be set in the
     * settings view.
     *
     * @since 1.0.0
     *
     * @return string - the contact output
     */
    private static function get_contact()
    {

        $result = "";
        $telephone = get_option("impressum_manager_phone");
        $fax = get_option("impressum_manager_fax");
        $email = get_option("impressum_manager_email");

        if (!empty($telephone)) {
            $result .= "<tr><td>Telefon: </td><td>$telephone</td></tr>";
        }
        if (!empty($fax)) {
            $result .= "<tr><td>Telefax: </td><td>$fax</td></tr>";
        }
        if (!empty($email) && get_option("impressum_manager_show_email_as_image") == "on") {
            $result .= "<tr><td>E-Mail: </td><td>" . sprintf("<img src='" . plugin_dir_url(__FILE__) . "impressum-manager-email-as-image.php?text=" . $email . "'>") . "</td></tr>";
        } elseif (!empty($email)) {
            $result .= "<tr><td>E-Mail: </td><td>$email</td></tr>";
        }

        if (strlen($result) > 0) {
            $result = "<h2>Kontakt:</h2>" . "<table>" . $result . "</table>";
        }

        return $result;
    }

    /**
     * Returns all the authorized persons which are set in the settings view.
     *
     * @since 1.0.0
     *
     * @return string
     */
    private static function get_authorized_person()
    {

        $result = "";

        $authorized_person = nl2br(get_option("impressum_manager_authorized_person"));

        if (!empty($authorized_person)) {
            $result .= "<h2>Vertreten durch:</h2>" . "<p>" . $authorized_person . "</p>";
        }

        return $result;
    }

    /**
     * Returns the full register values. To this, the register itself,
     * the cour and the register number are returned from this function.
     *
     * @since 1.0.0
     *
     * @return string
     */
    private static function get_register()
    {

        $register = get_option("impressum_manager_register");
        $register_court = get_option("impressum_manager_register_court");
        $registernr = get_option("impressum_manager_registenr");

        switch ($register) {
            case 1:
                $register_registered_in = __("Kein Register", SLUG);
                break;
            case 2:
                $register_registered_in = __("Genossenschaftsregister", SLUG);
                break;
            case 3:
                $register_registered_in = __("Handelsregister", SLUG);
                break;
            case 4:
                $register_registered_in = __("Partnerschaftsregister", SLUG);
                break;
            case 5:
                $register_registered_in = __("Vereinsregister", SLUG);
                break;
            default:
                $register_registered_in = __("Kein Register", SLUG);
                break;
        }

        if ((empty($register) || $register == 1) && empty($registernr) && empty($register_court)) {
            return "";
        }

        $result = "";
        $result .= "<h2>Registereintrag:</h2>";
        $result .= "<p>";

        if (!empty($register) && $register != 1) {
            $result .= $register_registered_in . "<br>";
        }
        if (!empty($register_court)) {
            $result .= $register_court . "<br>";
        }
        if (!empty($registernr)) {
            $result .= $registernr;
        }

        $result .= "</p>";

        return $result;
    }

    /**
     * Retuns the value added tax number. Can be set in the settings.
     *
     * @since 1.0.0
     *
     * @return string
     */
    private static function get_vat()
    {
        $result = "";

        $vat = get_option("impressum_manager_vat");

        if (!empty($vat)) {
            $result .= "<h2>Umsatzsteuer-ID:</h2>" . "<p>Umsatzsteuer-Identifikationsnummer gemäß §27 a Umsatzsteuergesetz:<br />" . $vat . "</p>";
        }

        return $result;
    }

    /**
     * Returns the regulatory authority. Can be set in the general/settings view.
     *
     * @since 1.0.0
     *
     * @return string
     */
    private static function get_regulatory_authority()
    {

        $result = "";

        $surveillance_authority = get_option('impressum_manager_surveillance_authority');

        $profession = get_option("impressum_manager_regulated_profession");
        $state = get_option("impressum_manager_state");
        $chamber = get_option("impressum_manager_chamber");
        $rules = get_option("impressum_manager_state_rules");
        $rules_link = get_option("impressum_manager_rules_link");

        if (strlen(get_option("impressum_manager_regulated_profession_checked")) > 0) {

            $result .= "<h2>Aufsichtsbehörde:</h2>";

            if (!empty($surveillance_authority)) {
                $result .= "<p>$surveillance_authority</p>";
            }

            $result .= "<p>";

            if (!empty($profession)) {
                $result .= __("Berufsbezeichnung", SLUG) . ": " . $profession . "<br>";
            }
            if (!empty($chamber)) {
                $result .= __("Zuständige Kammer", SLUG) . ": " . $chamber . "<br>";
            }
            if (!empty($state)) {
                $result .= __("Verliehen durch", SLUG) . ": " . $state . "<br>";
            }
            if (!empty($rules)) {
                $result .= __("Es gelten folgende berufsrechtliche Regelungen", SLUG) . ": " . $rules . "<br>";
            }
            if (!empty($rules_link)) {
                if (!preg_match("~^(?:f|ht)tps?://~i", $rules_link)) {
                    $rules_link = "http://" . $rules_link;
                }
                $result .= __("Regelungen einsehbar unter", SLUG) . ": " . "<a href='" . $rules_link . "'  target='_blank'>" . $rules_link . "</a>" . "<br>";
            }

            $result .= "</p>";
        }

        return $result;
    }

    /**
     * Returns the professional liability insurance. Will be set in the settings/general view or
     * in the onboarding process.
     *
     * @since 1.0.0
     *
     * @return string
     */
    private static function get_professional_liability_insurance()
    {

        $result = "";

        $name_and_adress = get_option('impressum_manager_name_and_adress');
        $space_of_appliance = get_option('impressum_manager_space_of_appliance');


        if (strlen(get_option("impressum_manager_professional_liability_insurance_checked")) > 0) {
            $result .= "<h2>Angaben zur Berufshaftpflichtversicherung:</h2>";
            $result .= "<p>Name und Sitz der Gesellschaft:<br>";
            $result .= $name_and_adress;
            $result .= "</p>";

            $result .= "<p>Geltungsraum der Versicherung: " . $space_of_appliance . "</p>";
        }

        return $result;
    }

    /**
     * Returns all the responsible persons for the website.
     *
     * @since 1.0.0
     *
     * @return string
     */
    private static function get_responsible_person()
    {
        $result = "";

        $responsible_persons = nl2br(get_option("impressum_manager_responsible_persons"));

        if (!empty($responsible_persons)) {
            $result = __("<h2>Verantwortlich für den Inhalt nach § 55 Abs. 2 RStV:</h2>", SLUG) . $responsible_persons . "<br>";
        }

        return $result;
    }

    /**
     * Retuns a nl2br string of all names added to each post image.
     * Each Image of a post has the possibility to add a name into an extra field
     * which can be used to credit the image creator. For example the creators of
     * fotolia.com
     *
     * @since 1.0.0
     *
     * @return string
     */
    private static function get_image_sources()
    {

        $image_source = get_option("impressum_manager_image_source");

        $creds = array();
        $i = 0;

        $result = "";

        $query_images_args = array(
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'post_status' => 'inherit',
            'posts_per_page' => -1,
        );

        $query_images = new WP_Query($query_images_args);
        foreach ($query_images->posts as $image) {
            $cred = trim(strip_tags(get_post_meta($image->ID, 'impressum_manager_image_credential', true)));
            if (!empty($cred)) {
                $creds[$i++] = $cred;
            }
        }

        $creds = array_unique($creds);
        foreach ($creds as $credit) {
            $result .= $credit . "<br>";
        }

        if (!empty($image_source)) {
            $result .= nl2br($image_source);
        }

        if (!empty ($result)) {
            $result = "<h2>" . __("Quellenangaben für die verwendeten Bilder und Grafiken:", SLUG) . "</h2>" . $result;
        }

        if (!empty($result)) {
            $result = "<p>" . $result . "</p>";
        }

        return $result;
    }

    /**
     * Returns the disclaimer of the website.
     * Can be edited in the wysiwyg editor in the impressum fields view.
     * Standard value is set in the activation hook and saved in the database.
     *
     * @since 1.0.0
     *
     * @return string
     */
    private static function get_disclaimer()
    {
        $result = "";

        if (get_option("impressum_manager_disclaimer") == true) {
            $result .= Impressum_Manager_Database::get_content(DISCLAIMER);
        }

        return $result;
    }

    /**
     * Returns the privacy policy of the website.
     * Can be edited in the wysiwyg editor in the impressum fields view.
     * Standard value is set in the activation hook and saved in the database.
     *
     * @since 1.0.0
     *
     * @return string
     */
    private static function get_privacy_policy()
    {

        $result = "";

        if (strlen(get_option("impressum_manager_general_privacy_policy")) > 0) {
            $result .= Impressum_Manager_Database::get_content(POLICY_GENERAL);
        }
        if (strlen(get_option("impressum_manager_policy_facebook")) > 0) {
            $result .= Impressum_Manager_Database::get_content(POLICY_FACEBOOK);
        }
        if (strlen(get_option("impressum_manager_policy_google_analytics")) > 0) {
            $result .= Impressum_Manager_Database::get_content(POLICY_ANALYTICS);
        }
        if (strlen(get_option("impressum_manager_policy_google_adsense")) > 0) {
            $result .= Impressum_Manager_Database::get_content(POLICY_ADSENSE);
        }
        if (strlen(get_option("impressum_manager_policy_google_plus")) > 0) {
            $result .= Impressum_Manager_Database::get_content(POLICY_GOOGLE_PLUS);
        }
        if (strlen(get_option("impressum_manager_policy_twitter")) > 0) {
            $result .= Impressum_Manager_Database::get_content(POLICY_TWITTER);
        }

        if (strlen($result) > 0) {
            $result = Impressum_Manager_Database::get_content(POLICY_HEADER) . $result . Impressum_Manager_Database::get_content(POLICY_END);
        }

        return $result;
    }

    /**
     * Returns the whole string of extra information, thah can be set in general and settings tab.
     *
     * @since 1.0.0
     *
     * @return string
     */
    private static function get_extra_field()
    {
        $result = "";

        $extra_field = get_option("impressum_manager_extra_field");
        if (!empty($extra_field)) {
            $result .= $extra_field;
        }

        return $result;
    }

}
