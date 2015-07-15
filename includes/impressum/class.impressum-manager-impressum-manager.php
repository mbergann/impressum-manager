<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

require_once(  plugin_dir_path( __FILE__ ) . '/model/class.impressum-manager-aimpressum.php' );
require_once(  plugin_dir_path( __FILE__ ) . '/model/class.impressum-manager-impressum.php' );
require_once(  plugin_dir_path( __FILE__ ) . '/model/class.impressum-manager-textunit.php' );;
require_once(  plugin_dir_path( __FILE__ ) . '/model/class.impressum-manager-text.php' );
require_once(  plugin_dir_path( __FILE__ ) . 'class.impressum-manager-impressum-factory.php' );

class Impressum_Manager_Impressum_Manager {

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
	 * Returns the currently created and used impressum.
	 *
	 * @return Impressum_Manager_Impressum
	 */
	public function get_impressum() {
		$imported_impressum = get_option("impressum_manager_use_imported_impressum");

		if ( !empty($imported_impressum) ) {
			$impressum = Impressum_Manager_Impressum_Factory::create_imported_impressum();
		} else {
			$impressum = Impressum_Manager_Impressum_Factory::create_generated_impressum();
		}

		return $impressum;
	}
}
