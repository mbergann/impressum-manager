<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * Activate function for that plugin
 */

function impressum_manager_install_activate()
{
    global $wpdb;

    $table_name = $wpdb->prefix . "impressum_manager_content";
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
	  `id` mediumint(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	  `lang` tinytext NULL,
	  `impressum_key` TEXT NULL,
	  `impressum_value` TEXT NULL
	) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);

    add_option("impressum_manager_db_version", "1.0");

	impressum_manager_pre_set_fields();

    impressum_manager_insert_data();
}

function impressum_manager_pre_set_fields(){
	Impressum_Manager_Database::getInstance()->save_option("impressum_manager_powered_by", true);
	Impressum_Manager_Database::getInstance()->save_option("impressum_manager_source_from", true);
	Impressum_Manager_Database::getInstance()->save_option( 'impressum_manager_confirmation', false );
}

function impressum_manager_insert_data()
{
    require_once plugin_dir_path(__FILE__) . "../admin/class.impressum-manager-admin.php";

    $impressum_key = array();

    $impressum_key['disclaimer'] = "<h1>Haftungsausschluss (Disclaimer)</h1><p><strong>Haftung für Inhalte</strong></p> <p>Als Diensteanbieter sind wir gemäß § 7 Abs.1 TMG für eigene Inhalte auf diesen Seiten nach den allgemeinen Gesetzen verantwortlich. Nach §§ 8 bis 10 TMG sind wir als Diensteanbieter jedoch nicht verpflichtet, übermittelte oder gespeicherte fremde Informationen zu überwachen oder nach Umständen zu forschen, die auf eine rechtswidrige Tätigkeit hinweisen. Verpflichtungen zur Entfernung oder Sperrung der Nutzung von Informationen nach den allgemeinen Gesetzen bleiben hiervon unberührt. Eine diesbezügliche Haftung ist jedoch erst ab dem Zeitpunkt der Kenntnis einer konkreten Rechtsverletzung möglich. Bei Bekanntwerden von entsprechenden Rechtsverletzungen werden wir diese Inhalte umgehend entfernen.</p> <p><strong>Haftung für Links</strong></p> <p>Unser Angebot enthält Links zu externen Webseiten Dritter, auf deren Inhalte wir keinen Einfluss haben. Deshalb können wir für diese fremden Inhalte auch keine Gewähr übernehmen. Für die Inhalte der verlinkten Seiten ist stets der jeweilige Anbieter oder Betreiber der Seiten verantwortlich. Die verlinkten Seiten wurden zum Zeitpunkt der Verlinkung auf mögliche Rechtsverstöße überprüft. Rechtswidrige Inhalte waren zum Zeitpunkt der Verlinkung nicht erkennbar. Eine permanente inhaltliche Kontrolle der verlinkten Seiten ist jedoch ohne konkrete Anhaltspunkte einer Rechtsverletzung nicht zumutbar. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Links umgehend entfernen.</p> <p><strong>Urheberrecht</strong></p> <p>Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen dem deutschen Urheberrecht. Die Vervielfältigung, Bearbeitung, Verbreitung und jede Art der Verwertung außerhalb der Grenzen des Urheberrechtes bedürfen der schriftlichen Zustimmung des jeweiligen Autors bzw. Erstellers. Downloads und Kopien dieser Seite sind nur für den privaten, nicht kommerziellen Gebrauch gestattet. Soweit die Inhalte auf dieser Seite nicht vom Betreiber erstellt wurden, werden die Urheberrechte Dritter beachtet. Insbesondere werden Inhalte Dritter als solche gekennzeichnet. Sollten Sie trotzdem auf eine Urheberrechtsverletzung aufmerksam werden, bitten wir um einen entsprechenden Hinweis. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Inhalte umgehend entfernen.</p>";
    $impressum_key['policy_header'] = "<h2>Datenschutzerklärung:</h2>";
    $impressum_key['policy_general'] = "<p><strong>Datenschutz</strong></p><p>Die Nutzung unserer Webseite ist in der Regel ohne Angabe personenbezogener Daten möglich. Soweit auf unseren Seiten personenbezogene Daten (beispielsweise Name, Anschrift oder eMail-Adressen) erhoben werden, erfolgt dies, soweit möglich, stets auf freiwilliger Basis. Diese Daten werden ohne Ihre ausdrückliche Zustimmung nicht an Dritte weitergegeben. </p><p>Wir weisen darauf hin, dass die Datenübertragung im Internet (z.B. bei der Kommunikation per E-Mail) Sicherheitslücken aufweisen kann. Ein lückenloser Schutz der Daten vor dem Zugriff durch Dritte ist nicht möglich. </p><p>Der Nutzung von im Rahmen der Impressumspflicht veröffentlichten Kontaktdaten durch Dritte zur Übersendung von nicht ausdrücklich angeforderter Werbung und Informationsmaterialien wird hiermit ausdrücklich widersprochen. Die Betreiber der Seiten behalten sich ausdrücklich rechtliche Schritte im Falle der unverlangten Zusendung von Werbeinformationen, etwa durch Spam-Mails, vor.</p>";
    $impressum_key['policy_facebook'] = "<p><strong>Datenschutzerkl&auml;rung f&uuml;r die Nutzung von Facebook-Plugins (Like-Button)</strong></p> <p>Auf unseren Seiten sind Plugins des sozialen Netzwerks Facebook (Facebook Inc., 1601 Willow Road, Menlo Park, California, 94025, USA) integriert. Die Facebook-Plugins erkennen Sie an dem Facebook-Logo oder dem &quot;Like-Button&quot; (&quot;Gef&auml;llt mir&quot;) auf unserer Seite. Eine &Uuml;bersicht &uuml;ber die Facebook-Plugins finden Sie hier: <a href=\"http://developers.facebook.com/docs/plugins/\" target=\"_blank\">http://developers.facebook.com/docs/plugins/</a>.<br /> Wenn Sie unsere Seiten besuchen, wird &uuml;ber das Plugin eine direkte Verbindung zwischen Ihrem Browser und dem Facebook-Server hergestellt. Facebook erh&auml;lt dadurch die Information, dass Sie mit Ihrer IP-Adresse unsere Seite besucht haben. Wenn Sie den Facebook &quot;Like-Button&quot; anklicken w&auml;hrend Sie in Ihrem Facebook-Account eingeloggt sind, k&ouml;nnen Sie die Inhalte unserer Seiten auf Ihrem Facebook-Profil verlinken. Dadurch kann Facebook den Besuch unserer Seiten Ihrem Benutzerkonto zuordnen. Wir weisen darauf hin, dass wir als Anbieter der Seiten keine Kenntnis vom Inhalt der &uuml;bermittelten Daten sowie deren Nutzung durch Facebook erhalten. Weitere Informationen hierzu finden Sie in der Datenschutzerkl&auml;rung von facebook unter <a href=\"http://de-de.facebook.com/policy.php\" target=\"_blank\"> http://de-de.facebook.com/policy.php</a></p> <p>Wenn Sie nicht w&uuml;nschen, dass Facebook den Besuch unserer Seiten Ihrem Facebook-Nutzerkonto zuordnen kann, loggen Sie sich bitte aus Ihrem Facebook-Benutzerkonto aus.</p>";
    $impressum_key['policy_analytics'] = "<p><strong>Datenschutzerkl&auml;rung f&uuml;r die Nutzung von Google Analytics</strong></p> <p>Diese Website benutzt Google Analytics, einen Webanalysedienst der Google Inc. (\"Google\"). Google Analytics verwendet sog. \"Cookies\", Textdateien, die auf Ihrem Computer gespeichert werden und die eine Analyse der Benutzung der Website durch Sie erm&ouml;glichen. Die durch den Cookie erzeugten Informationen &uuml;ber Ihre Benutzung dieser Website werden in der Regel an einen Server von Google in den USA &uuml;bertragen und dort gespeichert. Im Falle der Aktivierung der IP-Anonymisierung auf dieser Webseite wird Ihre IP-Adresse von Google jedoch innerhalb von Mitgliedstaaten der Europ&auml;ischen Union oder in anderen Vertragsstaaten des Abkommens &uuml;ber den Europ&auml;ischen Wirtschaftsraum zuvor gek&uuml;rzt.</p> <p>Nur in Ausnahmef&auml;llen wird die volle IP-Adresse an einen Server von Google in den USA &uuml;bertragen und dort gek&uuml;rzt. Im Auftrag des Betreibers dieser Website wird Google diese Informationen benutzen, um Ihre Nutzung der Website auszuwerten, um Reports &uuml;ber die Websiteaktivit&auml;ten zusammenzustellen und um weitere mit der Websitenutzung und der Internetnutzung verbundene Dienstleistungen gegen&uuml;ber dem Websitebetreiber zu erbringen. Die im Rahmen von Google Analytics von Ihrem Browser &uuml;bermittelte IP-Adresse wird nicht mit anderen Daten von Google zusammengef&uuml;hrt.</p> <p>Sie k&ouml;nnen die Speicherung der Cookies durch eine entsprechende Einstellung Ihrer Browser-Software verhindern; wir weisen Sie jedoch darauf hin, dass Sie in diesem Fall gegebenenfalls nicht s&auml;mtliche Funktionen dieser Website vollumf&auml;nglich werden nutzen k&ouml;nnen. Sie k&ouml;nnen dar&uuml;ber hinaus die Erfassung der durch das Cookie erzeugten und auf Ihre Nutzung der Website bezogenen Daten (inkl. Ihrer IP-Adresse) an Google sowie die Verarbeitung dieser Daten durch Google verhindern, indem sie das unter dem folgenden Link verf&uuml;gbare Browser-Plugin herunterladen und installieren: <a href=\"http://tools.google.com/dlpage/gaoptout?hl=de\">http://tools.google.com/dlpage/gaoptout?hl=de</a>.<p>&nbsp;</p>";
    $impressum_key['policy_adsense'] = "<p><strong>Datenschutzerkl&auml;rung f&uuml;r die Nutzung von Google Adsense</strong></p> <p>Diese Website benutzt Google AdSense, einen Dienst zum Einbinden von Werbeanzeigen der Google Inc. (&quot;Google&quot;). Google AdSense verwendet sog. &quot;Cookies&quot;, Textdateien, die auf Ihrem Computer gespeichert werden und die eine Analyse der Benutzung der Website erm&ouml;glicht. Google AdSense verwendet auch so genannte Web Beacons (unsichtbare Grafiken). Durch diese Web Beacons k&ouml;nnen Informationen wie der Besucherverkehr auf diesen Seiten ausgewertet werden.</p> <p>Die durch Cookies und Web Beacons erzeugten Informationen &uuml;ber die Benutzung dieser Website (einschlie&szlig;lich Ihrer IP-Adresse) und Auslieferung von Werbeformaten werden an einen Server von Google in den USA &uuml;bertragen und dort gespeichert. Diese Informationen k&ouml;nnen von Google an Vertragspartner von Google weiter gegeben werden. Google wird Ihre IP-Adresse jedoch nicht mit anderen von Ihnen gespeicherten Daten zusammenf&uuml;hren.</p> <p>Sie k&ouml;nnen die Installation der Cookies durch eine entsprechende Einstellung Ihrer Browser Software verhindern; wir weisen Sie jedoch darauf hin, dass Sie in diesem Fall gegebenenfalls nicht s&auml;mtliche Funktionen dieser Website voll umf&auml;nglich nutzen k&ouml;nnen. Durch die Nutzung dieser Website erkl&auml;ren Sie sich mit der Bearbeitung der &uuml;ber Sie erhobenen Daten durch Google in der zuvor beschriebenen Art und Weise und zu dem zuvor benannten Zweck einverstanden.</p>";
    $impressum_key['policy_google_plus'] = "<p><strong>Datenschutzerkl&auml;rung f&uuml;r die Nutzung von Google +1</strong></p> <p><i>Erfassung und Weitergabe von Informationen:</i><br /> Mithilfe der Google +1-Schaltfl&auml;che k&ouml;nnen Sie Informationen weltweit ver&ouml;ffentlichen. &Uuml;ber die Google&nbsp;+1-Schaltfl&auml;che erhalten Sie und andere Nutzer personalisierte Inhalte von Google und unseren Partnern. Google speichert sowohl die Information, dass Sie f&uuml;r einen Inhalt +1 gegeben haben, als auch Informationen &uuml;ber die Seite, die Sie beim Klicken auf +1 angesehen haben. Ihre +1 k&ouml;nnen als Hinweise zusammen mit Ihrem Profilnamen und Ihrem Foto in Google-Diensten, wie etwa in Suchergebnissen oder in Ihrem Google-Profil, oder an anderen Stellen auf Websites und Anzeigen im Internet eingeblendet werden.<br /> Google zeichnet Informationen &uuml;ber Ihre +1-Aktivit&auml;ten auf, um die Google-Dienste f&uuml;r Sie und andere zu verbessern. Um die Google&nbsp;+1-Schaltfl&auml;che verwenden zu k&ouml;nnen, ben&ouml;tigen Sie ein weltweit sichtbares, &ouml;ffentliches Google-Profil, das zumindest den f&uuml;r das Profil gew&auml;hlten Namen enthalten muss. Dieser Name wird in allen Google-Diensten verwendet. In manchen F&auml;llen kann dieser Name auch einen anderen Namen ersetzen, den Sie beim Teilen von Inhalten &uuml;ber Ihr Google-Konto verwendet haben. Die Identit&auml;t Ihres Google-Profils kann Nutzern angezeigt werden, die Ihre E-Mail-Adresse kennen oder &uuml;ber andere identifizierende Informationen von Ihnen verf&uuml;gen.<br /> <br /> <i>Verwendung der erfassten Informationen:</i><br /> Neben den oben erl&auml;uterten Verwendungszwecken werden die von Ihnen bereitgestellten Informationen gem&auml;&szlig; den geltenden Google-Datenschutzbestimmungen genutzt. Google ver&ouml;ffentlicht m&ouml;glicherweise zusammengefasste Statistiken &uuml;ber die +1-Aktivit&auml;ten der Nutzer bzw. gibt diese an Nutzer und Partner weiter, wie etwa Publisher, Inserenten oder verbundene Websites. </p>";
    $impressum_key['policy_twitter'] = "<p><strong>Datenschutzerkl&auml;rung f&uuml;r die Nutzung von Twitter</strong></p> <p>Auf unseren Seiten sind Funktionen des Dienstes Twitter eingebunden. Diese Funktionen werden angeboten durch die Twitter Inc., Twitter, Inc. 1355 Market St, Suite 900, San Francisco, CA 94103, USA. Durch das Benutzen von Twitter und der Funktion &quot;Re-Tweet&quot; werden die von Ihnen besuchten Webseiten mit Ihrem Twitter-Account verkn&uuml;pft und anderen Nutzern bekannt gegeben. Dabei werden auch Daten an Twitter &uuml;bertragen.</p> <p>Wir weisen darauf hin, dass wir als Anbieter der Seiten keine Kenntnis vom Inhalt der &uuml;bermittelten Daten sowie deren Nutzung durch Twitter erhalten. Weitere Informationen hierzu finden Sie in der Datenschutzerkl&auml;rung von Twitter unter <a href=\"http://twitter.com/privacy\" target=\"_blank\">http://twitter.com/privacy</a>.</p> <p>Ihre Datenschutzeinstellungen bei Twitter k&ouml;nnen Sie in den Konto-Einstellungen unter <a href=\"http://twitter.com/account/settings\" target=\"_blank\">http://twitter.com/account/settings</a> &auml;ndern.</p><p>";
    $impressum_key['policy_end'] = "<strong>Auskunft, L&ouml;schung, Sperrung</strong></p> <p>Sie haben jederzeit das Recht auf unentgeltliche Auskunft &uuml;ber Ihre gespeicherten personenbezogenen Daten, deren Herkunft und Empf&auml;nger und den Zweck der Datenverarbeitung sowie ein Recht auf Berichtigung, Sperrung oder L&ouml;schung dieser Daten. Hierzu sowie zu weiteren Fragen zum Thema personenbezogene Daten k&ouml;nnen Sie sich jederzeit &uuml;ber die im Impressum angegeben Adresse des Webseitenbetreibers an uns wenden.</p>";

    foreach ($impressum_key as $key => $value) {
        impressum_manager_insert_impressum_field($key, $value, 'DE');
    }
}

function impressum_manager_insert_impressum_field($key, $value, $lang)
{
    global $wpdb;

    $table_name = $wpdb->prefix . "impressum_manager_content";

    if (!impressum_manager_check_for_lang_tag($key)) {
        $wpdb->insert(
            $table_name,
            array(
                'lang' => $lang,
                'impressum_key' => $key,
                'impressum_value' => $value
            ),
            array(
                '%s',
                '%s',
                '%s'
            )
        );
    }
}

function impressum_manager_check_for_lang_tag($key)
{
    global $wpdb;
    $table_name = $wpdb->prefix . "impressum_manager_content";
    $key_result = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE impressum_key LIKE %s", $key));
    if ($key_result) return true;
    return false;
}

?>
