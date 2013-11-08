<?php

namespace Polycademy\Validation\Rule;

class TrueString implements \Polycademy\Validation\Rule {

	public function validate($field, $value, $validator) {

		$bool = filter_var($value, FILTER_VALIDATE_BOOLEAN);
		return $bool;

	}

	public function get_error_message($field, $value, $validator) {

		return $validator->get_label($field) . ' must be true, 1, on, or yes';

	}

}