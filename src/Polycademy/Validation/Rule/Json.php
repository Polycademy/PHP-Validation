<?php

namespace Polycademy\Validation\Rule;

class Json implements \Polycademy\Validation\Rule {

	public function validate($field, $value, $validator) {

		json_decode($value);
		return (json_last_error() == JSON_ERROR_NONE);

	}

	public function get_error_message($field, $value, $validator) {

		return $validator->get_label($field) . " must be valid json";

	}

}