<?php

namespace se\Object4Method;

class ParametersDefinitionsSet {

	/**
	 * @var array
	 */
	protected $parameters;

	public function __construct(array $definitions = array()) {
		foreach($definitions as $definition) {
			$this->add($definition);
		}
	}

	/**
	 * @return ParameterDefinition[]
	 */
	public function getAll() {
		return $this->parameters;
	}

	/**
	 * @param $name
	 *
	 * @return ParameterDefinition
	 */
	public function get($name) {
		return $this->parameters[$name];
	}

	/**
	 * @param ParameterDefinition $definition
	 *
	 * @return ParametersDefinitionsSet
	 */
	public function add(ParameterDefinition $definition) {
		$this->parameters[$definition->getName()] = $definition;
		return $this;
	}
}