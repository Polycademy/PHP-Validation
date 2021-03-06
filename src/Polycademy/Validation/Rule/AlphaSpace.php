<?php

namespace Polycademy\Validation\Rule;

/**
 * Ensure all characters are in a-z
 *
 * @package Validation
 * @author Luke Lanchester <luke@lukelanchester.com>
 **/
class AlphaSpace implements \Polycademy\Validation\Rule {


	/**
	 * Validate this Rule
	 *
	 * @param string Field name
	 * @param string Field value
	 * @param Validator Validator object
	 * @return bool True if rule passes
	 **/
	public function validate($field, $value, $validator) {
		if(empty($value)) return true;
		return ctype_alpha(str_replace(' ', '', $value));
	} // end func: validate



	/**
	 * Return error message for this Rule
	 *
	 * @param string Field name
	 * @param string Field value
	 * @param Validator Validator object
	 * @return string Error message
	 **/
	public function get_error_message($field, $value, $validator) {
		return $validator->get_label($field) . ' must use just the letters A to Z with whitespace allowed';
	} // end func: get_error_message



} // end class: Alpha