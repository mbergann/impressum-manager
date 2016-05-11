<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class Impressum_Manager_Shortcode_Manager {

	static private $instance = null;

	static public function getInstance() {
		if ( null === self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	private function __construct() {
	}

	private function __clone() {
	}

	public static function init() {
		add_shortcode( "impressum_manager", array( 'Impressum_Manager_Shortcode_Manager', 'content_shortcode' ) );
	}

	/**
	 * The actual shortcode method. Will return the impressum
	 * contents of a part of the impressum. [impressum_manager]
	 * will return the full impressum. [impresusm_manager type=xxx]
	 * will return the part xxx of the impressum.
	 * [impressum_manager var=xxx] will load a specific variable.
	 *
	 * @since 1.0.0
	 *
	 * @param $atts
	 *
	 * @return mixed|string
	 */
	public static function content_shortcode( $atts ) {
		$result = "";

		$impressum = Impressum_Manager_Impressum_Manager::getInstance()->get_impressum();

		if ( ! empty( $atts ) ) {
			if ( isset( $atts['type'] ) ) {
				$result = $impressum->get_component_by_atts( $atts )->draw();
				if ( get_option( "impressum_manager_powered_by" ) == true ) {
					$result .= "<p>Plugin von <a href=\"http://www.impressum-manager.com\">http://www.impressum-manager.com</a></p>";
				}

				if ( get_option( "impressum_manager_source_from" ) == true) {
					$result .= "<p>Quelle: <em><a rel=\"nofollow\" href=\"http://www.e-recht24.de/impressum-generator.html\">http://www.e-recht24.de</a></em></p>";
				}
			} else {
				switch ( strtolower( $atts["var"] ) ) {
					case "company name":
						$result = get_option( "impressum_manager_name_company" );
						break;
					case "address":
						$result = get_option( "impressum_manager_address" );
						break;
					case "address axtra":
						$result = get_option( "impressum_manager_address_extra" );
						break;
					case "place":
						$result = get_option( "impressum_manager_place" );
						break;
					case "zip":
						$result = get_option( "impressum_manager_zip" );
						break;
					case "county":
						$result = get_option( "impressum_manager_country" );
						break;
					case "fax":
						$result = get_option( "impressum_manager_fax" );
						break;
					case "email":
						$result = get_option( "impressum_manager_email" );
						break;
					case "phone":
						$result = get_option( "impressum_manager_phone" );
						break;
					case "authorized person":
						$result = get_option( "impressum_manager_authorized_person" );
						break;
					case "vat":
						$result = get_option( "impressum_manager_vat" );
						break;
					case "register number":
						$result = get_option( "impressum_manager_registenr" );
						break;
					case "regulated profession":
						$result = get_option( "impressum_manager_regulated_profession" );
						break;
					case "state":
						$result = get_option( "impressum_manager_state" );
						break;
					case "state rules":
						$result = get_option( "impressum_manager_state_rules" );
						break;
					case "responsible persons":
						$result = get_option( "impressum_manager_responsible_persons" );
						break;
					case "responsible chamber":
						$result = get_option( "impressum_manager_responsible_chamber" );
						break;
					case "image source":
						$result = get_option( "impressum_manager_image_source" );
						break;
					case "register": {
						$nr = get_option( "impressum_manager_register" );
						switch ( $nr ) {
							case 1:
								$result = __( "Kein Register" );
								break;
							case 2:
								$result = __( "Genossenschaftsregister" );
								break;
							case 3:
								$result = __( "Handelsregister" );
								break;
							case 4:
								$result = __( "Partnerschaftsregister" );
								break;
							case 5:
								$result = __( "Vereinsregister" );
								break;
						}
					};
						break;
					case "form": {
						$form = get_option( "impressum_manager_form_of_organization" );
						switch ( $form ) {
							case 1:
								$result = __( "Einzelunternehmen" );
								break;
							case 2:
								$result = __( "Stille Gesellschaft" );
								break;
							case 3:
								$result = __( "Offene Handelsgesellschaft (OHG)" );
								break;
							case 4:
								$result = __( "Kommanditgesellschaft (KG)" );
								break;
							case 5:
								$result = __( "Gesellschaft bürgerlichen Rechts (GdR)" );
								break;
							case 6:
								$result = __( "Aktiengesellschaft (AG)" );
								break;
							case 7:
								$result = __( "Kommanditgesellschaft auf Aktien (KGaA)" );
								break;
							case 8:
								$result = __( "Gesellschaft mit beschränkter Haftung (GmbH)" );
								break;
							case 9:
								$result = __( "Genossenschaft (eG)" );
								break;
                            case 10:
                                $result = __( "Eingetragener Verein (e.V.)" );
						}
					};

						break;
				}
			}
		} else {
			$result = $impressum->draw();

            if ( get_option( "impressum_manager_powered_by" ) == true ) {
                $result .= "<p>Plugin von <a href=\"http://www.impressum-manager.com\">http://www.impressum-manager.com</a></p>";
            }

            if ( get_option( "impressum_manager_source_from" ) == true) {
                $result .= "<p>Quelle: <em><a rel=\"nofollow\" href=\"http://www.e-recht24.de/impressum-generator.html\">http://www.e-recht24.de</a></em></p>";
            }
		}

		return $result;
	}

	/**
	 * Function to hook to "the_posts". A nice trick to workaround the
	 * shortcode problem.
	 *
	 * @since 1.0.0
	 *
	 * @param $posts
	 *
	 * @return mixed
	 */
	public static function metashortcode( $posts ) {
		$shortcode         = 'impressum_manager';
		$callback_function = array('Impressum_Manager_Shortcode_Manager', 'metashortcode_setmeta');

		return self::metashortcode_shortcode_to_wphead( $posts, $shortcode, $callback_function );
	}

	/**
	 * To execute when shortcode is found. Will add
	 * noindex paramter to the page of that impressum
	 * specific page.
	 *
	 * @since 1.0.0
	 */
	public static function metashortcode_setmeta() {
        if(!is_admin())
		    echo '<meta name="robots" content="noindex,nofollow">';
	}

	/**
	 * Add meta stuff to the wp head before executing shortcode.
	 * Good workaround for the request query.
	 *
	 * @param $posts
	 * @param $shortcode
	 * @param $callback_function
	 *
	 * @return mixed
	 */
	public static function metashortcode_shortcode_to_wphead( $posts, $shortcode, $callback_function ) {
		if ( empty( $posts ) ) {
			return $posts;
		}

		$show_noindex    = get_option( "impressum_manager_noindex" );
		$execute_wp_head = false;

		if ( $show_noindex !== false && strlen( $show_noindex ) > 0 ) {
			$execute_wp_head = true;
		}

		$found = false;
		foreach ( $posts as $post ) {
			if ( stripos( $post->post_content, '[' . $shortcode ) !== false ) {
				$found = true;
				break;
			}
		}

		if ( $found && $execute_wp_head ) {
            // remove standard no index
            if ( $execute_wp_head ) {
                remove_action( 'wp_head', 'noindex', 1 );
            }
            // remove others plugin noindex
            if ( $execute_wp_head ) {
                // Yoast Seo
                if ( class_exists( 'WPSEO_Frontend' ) ) {
                    ob_start();
                    $wpseo = WPSEO_Frontend::get_instance();
                    ob_end_clean();
                    remove_action( 'wpseo_head', array( $wpseo, 'robots' ) );
                }

                // WP SEO by sergej müller
                if ( class_exists( 'wpSEO_Output' ) ) {
                    remove_action( 'wpseo_the_robots', array( 'wpSEO_Output', 'the_robots' ) );
                }

                // Wordpress Meta Robots
                if ( class_exists( 'wp_meta_robots_plugin' ) ) {
                    remove_action( 'wp_head', array( 'wp_meta_robots_plugin', 'add_meta_robots_tag' ) );
                }
            }

			add_action( 'wp_head', $callback_function );
		}

		return $posts;
	}

}


?>
