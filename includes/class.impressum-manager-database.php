<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class Impressum_Manager_Database {

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

	/**
	 * Helper method for getting values from the database.
	 *
	 * @since 1.0.0
	 *
	 * @param $key
	 *
	 * @return mixed
	 */
	public static function get_content( $key ) {
		global $wpdb;

		$table_name = $wpdb->prefix . "impressum_manager_content";

		$result = $wpdb->get_var(
			"SELECT impressum_value
              FROM $table_name
              WHERE impressum_key = '$key'" );

		return $result;
	}

	/**
	 * Helper method for saving an option.
	 *
	 * @since 1.0.0
	 *
	 * @param $name
	 * @param $val
	 */
	public static function save_option( $name, $val ) {
		if ( get_option( $name ) !== false ) {
			update_option( $name, $val );
		} else {
			add_option( $name, $val );
		}
	}
}
