<?php

namespace Polycademy\Validation\Rule;

class Date implements \Polycademy\Validation\Rule {

	protected $format;

	public function __construct($format) {

		$this->format = $format;
	
	}

	public function validate($field, $value, $validator) {

		#count between 8 and 10 characters (because of separators)
		if(strlen($value) >= 8 && strlen($value) <= 10){
		
			#based on the $format (which could be DD-MM-YYYY), it removes the characters and leaves the separators (-)
			$separator_only = str_replace(array('M','D','Y'),'', $this->format);
			$separator = $separator_only[0];
			
			#there needs tobe a separator!, or it fails
			if($separator){
			
				#looks for the separator, and adds 1 backslash \
				$regexp = str_replace($separator, '\\' . $separator, $this->format);
				#replaces the MM in the format(now $regexp) with MM and so on
				$regexp = str_replace('MM', '(0[1-9]|1[0-2])', $regexp);
				$regexp = str_replace('M', '(0?[1-9]|1[0-2])', $regexp);
				$regexp = str_replace('DD', '(0[1-9]|[1-2][0-9]|3[0-1])', $regexp);
				$regexp = str_replace('D', '(0?[1-9]|[1-2][0-9]|3[0-1])', $regexp);
				$regexp = str_replace('YYYY', '\d{4}', $regexp);
				$regexp = str_replace('YY', '\d{2}', $regexp);
				#the regexp is constructed, proceed to look for match!
				if($regexp != $value && preg_match('/'.$regexp.'$/', $value)){
				
					#explode the format, explode the date, combine, and now construct new values
					foreach(array_combine(explode($separator, $this->format), explode($separator, $value)) as $key => $value){
					
						if ($key == 'YY') $year = '20' . $value;
						if ($key == 'YYYY') $year = $value;
						if ($key[0] == 'M') $month = $value;
						if ($key[0] == 'D') $day = $value;
					
					}
					
					#everything has been constructed, if its a valid date, then proceed to return true
					if(checkdate($month, $day, $year)) return true;
					
				}
				
			}
			
		}
		
		return false;

	}

	public function get_error_message($field, $value, $validator) {

		return $validator->get_label($field) . " must match this {$this->format} format";

	}

}