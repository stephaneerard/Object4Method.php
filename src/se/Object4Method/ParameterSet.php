<?php

namespace se\Object4Method;

class ParameterSet {

	protected $parameters = array();

	public function __construct(array $parameters = array()) {
		foreach ($parameters as $name => $value) {
			$this->set($name, $value);
		}
	}

	public function get($name, $default = NULL) {
		if (isset($this->parameters[$name])) {
			return $this->parameters[$name];
		}
		return $default;
	}

	public function getAll() {
		return $this->parameters;
	}

	public function has($name) {
		return isset($this->parameters[$name]);
	}

	public function set($name, $value, $overwrite = TRUE) {
		if (!$overwrite && $this->has($name)) {
			return;
		} else {
			$this->parameters[$name] = $value;
		}

		return $this;
	}

	public function setAll($parameters, $overwrite = TRUE) {
		foreach ($parameters as $name => $value) {
			$this->set($name, $value, $overwrite);
		}
	}
}