<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

abstract class Impressum_Manager_AImpressum {

	/**
	 * Adds a $unit of type Impressum_Manager_AImpressum to the composite.
	 *
	 * @param Impressum_Manager_AImpressum $unit
	 *
	 * @return mixed
	 */
	abstract function add(Impressum_Manager_AImpressum $unit);

	/**
	 * Returns a string with all $text information of the composite.
	 *
	 * @return mixed
	 */
	abstract function draw();

	/**
	 * Returns the shortcode of a unit.
	 *
	 * @return mixed
	 */
	abstract function get_shortcode();

	/**
	 * Returns the name of a unit.
	 *
	 * @return mixed
	 */
	abstract function get_name();

	/**
	 * Returns all unit-components of the composite.
	 *
	 * @return mixed
	 */
	abstract function get_components();

	/**
	 * Returns true if all compositing unit-component and the object itself has an empty $text.
	 *
	 * @return mixed
	 */
	abstract function is_empty();

	/**
	 * Returns true if the variable $text of the unit-components or the object itself is not empty.
	 *
	 * @return mixed
	 */
	abstract function has_content();
}
