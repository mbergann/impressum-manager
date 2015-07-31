<?php

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

delete_option("impressum_manager_person");
delete_option("impressum_manager_form_of_organization");
delete_option("impressum_manager_name_company");
delete_option("impressum_manager_address");
delete_option("impressum_manager_address_extra");
delete_option("impressum_manager_place");
delete_option("impressum_manager_zip");
delete_option("impressum_manager_country");
delete_option("impressum_manager_fax");
delete_option("impressum_manager_email");
delete_option("impressum_manager_phone");
delete_option("impressum_manager_authorized_person");
delete_option("impressum_manager_vat");
delete_option("impressum_manager_register");
delete_option("impressum_manager_registenr");
delete_option("impressum_manager_regulated_profession");
delete_option("impressum_manager_state");
delete_option("impressum_manager_state_rules");
delete_option("impressum_manager_chamber");
delete_option("impressum_manager_image_source");
delete_option("impressum_manager_responsible_chamber");
delete_option("impressum_manager_responsible_persons");
delete_option("impressum_manager_disclaimer");
delete_option("impressum_manager_general_privacy_policy");
delete_option("impressum_manager_policy_facebook");
delete_option("impressum_manager_policy_google_analytics");
delete_option("impressum_manager_regulated_profession_checked");
delete_option("impressum_manager_allowness");
delete_option("impressum_manager_press_content");
delete_option("impressum_manager_disabled");
delete_option("impressum_manager_notice");
delete_option("impressum_manager_extra_field");
delete_option("impressum_manager_id");
delete_option("impressum_manager_policy_google_plus");
delete_option("impressum_manager_policy_twitter");
delete_option("impressum_manager_onboarding_conf");
delete_option("impressum_manager_register_court");
delete_option("impressum_manager_surveillance_authority");
delete_option("impressum_manager_rules_link");
delete_option("impressum_manager_professional_liability_insurance_checked");
delete_option("impressum_manager_name_and_adress");
delete_option("impressum_manager_space_of_appliance");
delete_option("impressum_manager_noindex");
delete_option("impressum_manager_show_email_as_image");
delete_option("impressum_manager_source_from");
delete_option("impressum_manager_powered_by");
delete_option("impressum_manager_policy_google_adsense");
delete_option("impressum_manager_skip_start");
delete_option("impressum_manager_confirmation");


unregister_setting("impressum-manager-general-settings","impressum_manager_confirmation");

unregister_setting("impressum-manager-general-tab", "impressum_manager_disclaimer");
unregister_setting("impressum-manager-general-tab", "impressum_manager_general_privacy_policy");
unregister_setting("impressum-manager-general-tab", "impressum_manager_policy_facebook");
unregister_setting("impressum-manager-general-tab", "impressum_manager_policy_google_analytics");
unregister_setting("impressum-manager-general-tab", "impressum_manager_policy_google_adsense");
unregister_setting("impressum-manager-general-tab", "impressum_manager_policy_twitter");
unregister_setting("impressum-manager-general-tab", "impressum_manager_policy_google_plus");

unregister_setting("impressum-manager-import-tab", "impressum_manager_disabled");
unregister_setting("impressum-manager-import-tab", "impressum_manager_extra_field");
unregister_setting("impressum-manager-import-tab", "impressum_manager_noindex");
unregister_setting("impressum-manager-import-tab", "impressum_manager_show_email_as_image");
unregister_setting("impressum-manager-import-tab", "impressum_manager_source_from");
unregister_setting("impressum-manager-import-tab", "impressum_manager_powered_by");

unregister_setting("impressum-manager-settings", "impressum_manager_person");
unregister_setting("impressum-manager-settings", "impressum_manager_form_of_organization");
unregister_setting("impressum-manager-settings", "impressum_manager_name_company");
unregister_setting("impressum-manager-settings", "impressum_manager_address");
unregister_setting("impressum-manager-settings", "impressum_manager_address_extra");
unregister_setting("impressum-manager-settings", "impressum_manager_place");
unregister_setting("impressum-manager-settings", "impressum_manager_zip");
unregister_setting("impressum-manager-settings", "impressum_manager_country");
unregister_setting("impressum-manager-settings", "impressum_manager_fax");
unregister_setting("impressum-manager-settings", "impressum_manager_email");
unregister_setting("impressum-manager-settings", "impressum_manager_disclaimer");
unregister_setting("impressum-manager-settings", "impressum_manager_phone");
unregister_setting("impressum-manager-settings", "impressum_manager_authorized_person");
unregister_setting("impressum-manager-settings", "impressum_manager_vat");
unregister_setting("impressum-manager-settings", "impressum_manager_register");
unregister_setting("impressum-manager-settings", "impressum_manager_register_court");
unregister_setting("impressum-manager-settings", "impressum_manager_registenr");
unregister_setting("impressum-manager-settings", "impressum_manager_surveillance_authority");
unregister_setting("impressum-manager-settings", "impressum_manager_regulated_profession_checked");
unregister_setting("impressum-manager-settings", "impressum_manager_regulated_profession");
unregister_setting("impressum-manager-settings", "impressum_manager_state");
unregister_setting("impressum-manager-settings", "impressum_manager_state_rules");
unregister_setting("impressum-manager-settings", "impressum_manager_chamber");
unregister_setting("impressum-manager-settings", "impressum_manager_rules_link");
unregister_setting("impressum-manager-settings", "impressum_manager_image_source");
unregister_setting("impressum-manager-settings", "impressum_manager_responsible_persons");
unregister_setting("impressum-manager-settings", "impressum_manager_press_content");
unregister_setting("impressum-manager-settings", "impressum_manager_professional_liability_insurance_checked");
unregister_setting("impressum-manager-settings", "impressum_manager_name_and_adress");
unregister_setting("impressum-manager-settings", "impressum_manager_space_of_appliance");

global $wpdb;
// delete table
$table_name = $wpdb->prefix . "impressum_manager_content";
$sql = "DROP TABLE IF EXISTS {$table_name};";
$e = $wpdb->query($sql);


