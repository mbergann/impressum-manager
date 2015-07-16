<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class Impressum_Manager_Textunit extends Impressum_Manager_AImpressum{

	private $shortcode;
	private $name;
	private $text;

	function __construct($shortcode, $name, $text){
		$this->shortcode = $shortcode;
		$this->name = $name;
		$this->text = $text;
	}

	function add(Impressum_Manager_AImpressum $unit){}

	function draw(){
		return $this->text;
	}

	function get_shortcode(){
		return $this->shortcode;
	}

	function get_name(){
		return $this->name;
	}

	function get_components(){
		return $this;
	}

	function is_empty(){
		return empty($this->text);
	}

	function has_content(){
		return !empty($this->text);
	}
}
