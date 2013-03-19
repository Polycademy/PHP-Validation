Validation Library
==================

A simple, extensible validation library for PHP with support
for filtering and validating any input array. Provides a more concise
interface than the upstream fork.

0.0 Table of Contents
---------------------

* Introduction
* Examples
* Rule Reference


1.0 Introduction
----------------

This library provides a simple way to validate an input
array against a set of rules. Input could come from $_POST
or any other data source.

Each field can have its own label, pre-filters and rules
applied to it. Rules extend a very simple interface, making
adding custom rules very easy. The Validator object itself
can be executed multiple times against different datasets,
making it very useful for processing dynamic data.


2.0 Examples
------------

```php
use Polycademy\Validation\Validator;
use Polycademy\Validation\Rule;

$validator = new Validator();
$validator
	->set_label('name', 'first name')
	->set_label('email', 'email address')
	->set_label('password2', 'password confirmation')
	->add_filter('name', 'trim')
	->add_filter('email', 'trim')
	->add_filter('email', 'strtolower')
	->add_rule('name', new Rule\MinLength(5))
	->add_rule('name', new Rule\MaxLength(10))
	->add_rule('email', new Rule\MinLength(5))
	->add_rule('email', new Rule\Email())
	->add_rule('password', new Rule\Matches('password2'))
;

if($validator->is_valid($_POST)) {
	print_r($validator->get_data());
} else {
	print_r($validator->get_errors());
}
```

Or you can use the setup_rules and fluently add all the rules.

```php
use Polycademy\Validation\Validator;
use Polycademy\Validation\Rule;

$validator = new Validator();

$validator->setup_rules(array(
	'name' => array(
		'set_label:Course Name',
		'NotEmpty',
		'AlphaNumericSpace',
		'MinLength:5',
		'MaxLength:50',
	),
	'starting_date' => array(
		'set_label:Starting Date',
		'Regex:/^(19|20)\d\d\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$/',
	),
	'days_duration' => array(
		'set_label:Course Duration',
		'NotEmpty',
		'Number',
		'NumRange:1,200',
	),
	'times' => array(
		'set_label:Course Times',
		'NotEmpty',
		'MinLength:1',
		'MaxLength:100',
		'AlphaNumericSpace',
	),
	'number_of_applications' => array(
		'set_label:Number of Applicants',
		'Number',
		'NumRange:0,100',
	),
	'number_of_students' => array(
		'set_label:Number of Students',
		'Number',
		'NumRange:0,100',
	),
));

if(!$validator->is_valid($data)){

	//returns array of key for data and value
	$errors = $this->validator->get_errors();
	
}
```

More detailed examples can be found in ./examples.


3.0 Rule Reference
------------------

* **NotEmpty** Makes this a required field
* **Equal** Input must match provided string
* **NotEqual** Input must not match provided string
* **Matches** Input must match value of another field
* **InArray** Input must be in an array of values
* **MinLength** Input length must be greater than or equal to value
* **MaxLength** Input length must be less  than or equal to value
* **ExactLength** Input length must be exactly value
* **Alpha** Input can only contain a-z characters
* **AlphaSpace** Input can only contain a-z characters and whitespace
* **AlphaNumeric** Input can contain a-z and 0-9
* **AlphaNumericSpace** Input can contain a-z and 0-9 and whitespace
* **AlphaSlug** Input can contain a-z, 0-9, - and _
* **Regex** Input must match provided regular expression
* **Email** Input must be a valid email format
* **URL** Input must be a valid URL format
* **IP** Input must be a valid IPv4 or v6 address
* **True** Input must be true e.g. checkbox
* **Number** Input must be numeric e.g. -99 or 123.45
* **NumNatural** Input must be an integer zero or above
* **NumMin** Input value must be greater than or equal to value
* **NumMax** Input value must be less than or equal to value
* **NumRange** Input value must be between min and max values