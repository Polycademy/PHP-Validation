<?php

namespace Polycademy\Validation\Rule;

class MaxWordLength implements \Polycademy\Validation\Rule {

	protected $length = 0;

	public function __construct($length) {
		$this->length = (int) $length;
	}

	public function validate($field, $value, $validator) {

		if(str_word_count($value, 0) > $this->length){
			return false;
		}
		return true;

	}

	public function get_error_message($field, $value, $validator) {

		return $validator->get_label($field) . " cannot be longer than {$this->length} words in length";
	
	}

}