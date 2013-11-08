<?php

namespace Polycademy\Validation\Rule;

/**
 * Input field has to exist in the data that was passed in
 **/
class Exists implements \Polycademy\Validation\Rule {

	public function validate($field, $value, $validator) {

		$data = $validator->get_data();
		return array_key_exists($field, $data);

	}

	public function get_error_message($field, $value, $validator) {

		return $validator->get_label($field) . ' must exist';

	}

}