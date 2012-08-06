<?php

namespace se\Object4Method;

class ParameterDefinition {

	protected $name;
	protected $check_callback;

	public function __construct($name, $check_callback) {
		if(!is_callable($check_callback)) {
			throw new \Exception('$check_callback is not callable');
		}
		$this->name = (string) $name;
		$this->check_callback = $check_callback;
	}

	public function getName() {
		return $this->name;
	}

	public function isValueValid($value) {
		return call_user_func($this->check_callback, $value);
	}

	public function getCheckCallback() {
		return $this->check_callback;
	}
}