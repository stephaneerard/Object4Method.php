<?php

namespace se\Object4Method;

abstract class AbstractMethod {

	/**
	 * @var ParametersDefinitionsSet
	 */
	protected $definition;
	/**
	 * @var array
	 */
	protected $parameters;
	/**
	 * @var mixed
	 */
	protected $value;

	/**
	 * @param ParametersDefinitionsSet $definition
	 *
	 */
	public function __construct(ParametersDefinitionsSet $definition = NULL) {
		if ($definition) {
			$this->setDefinition($definition);
		}
		$this->parameters = new ParameterSet();
		$this->setup();
	}

	/**
	 * Setup the Method object
	 *
	 * When you subclass this class, you'll be able to
	 * define this object's definition by implementing this method
	 *
	 * @abstract
	 * @return AbstractMethod
	 */
	abstract protected function setup();

	/**
	 * @param ParametersDefinitionsSet $definition
	 *
	 * @return AbstractMethod
	 */
	public function setDefinition(ParametersDefinitionsSet $definition) {
		$this->definition = $definition;
		return $this;
	}

	/**
	 * Gives an array of parameters to run the method.
	 * If none have been set, ->getDefaultParameters() will be used.
	 *
	 * @param array $parameters
	 *
	 * @return AbstractMethod
	 */
	public function setParameters(array $parameters = array()) {
		$parameters = array_merge($this->getDefaultParameters(), $parameters);
		$this->parameters->setAll($parameters);
		return $this;
	}

	/**
	 * Will check the parameters against the chec_callback functions
	 * given to the ParametersDefinitionsSet object
	 *
	 * @return AbstractMethod
	 * @throws \InvalidArgumentException
	 */
	protected function checkParameters() {
		$stack = array();
		foreach ($this->definition->getAll() as $name => $definition) {

			try {
				$is_valid = $definition->isValueValid($this->parameters->get($name), $this);
				if (!$is_valid) {
					throw new \InvalidArgumentException(sprintf('%s is not a valid argument', $name));
				}
			}
			catch (\InvalidArgumentException $e) {
				$stack[$name] = $e;
			}
		}

		if (count($stack) > 0) {
			throw new \InvalidArgumentException('Invalid arguments');
		}

		return $this;
	}

	/**
	 * @param ParameterSet $parameters
	 *
	 * @return AbstractMethod
	 */
	public function execute(array $parameters = NULL) {
		if ($parameters) {
			$this->parameters->setAll($parameters);
		}
		$this->checkParameters();
		$this->preCheck();
		$this->value = $this->run();
		$this->postCheck();

		return $this;
	}

	/**
	 * Returns the method last run return's value
	 *
	 * @return mixed
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * Overload this method in your subclass to specify
	 * the defaults
	 *
	 * @return array
	 */
	public function getDefaultParameters() {
		return array();
	}

	/**
	 * Overload this method to implement a preCheck
	 *
	 * @abstract
	 * @return mixed
	 */
	abstract public function preCheck();

	/**
	 * Overload this method to implement a postcheck
	 *
	 * @abstract
	 * @return mixed
	 */
	abstract public function postCheck();

	/**
	 * The body of the method
	 *
	 * @abstract
	 * @return mixed
	 */
	abstract protected function run();

}