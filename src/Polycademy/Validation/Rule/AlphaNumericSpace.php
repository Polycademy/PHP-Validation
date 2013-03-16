<?php

namespace Polycademy\Validation\Rule;

/**
 * Ensure characters are a-z or 0-9 with the ability to have whitespace
 *
 * @package Validation
 * @author Roger Qiu
 **/
class AlphaNumericSpace implements \Polycademy\Validation\Rule {

	public function validate($field, $value, $validator) {
		if(empty($value)) return true;
		if(!ctype_alnum(str_replace(' ', '', $value))) {
			return false;
		}
	} // end func: validate

	public function get_error_message($field, $value, $validator) {
		return $validator->get_label($field) . ' must use just the letters A to Z or numbers 0-9 with whitespace allowed';
	} // end func: get_error_message

} // end class: AlphaNumeric with Space