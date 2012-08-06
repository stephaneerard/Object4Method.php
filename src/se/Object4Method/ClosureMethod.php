<?php

namespace se\Object4Method;

class ClosureMethod extends AbstractMethod {

	/**
	 * @var callable
	 */
	protected $callable;

	/**
	 * @var callable
	 */
	protected $preCheckCallable;

	/**
	 * @var callable
	 */
	protected $postCheckCallable;

	/**
	 * @var array
	 */
	protected $defaultParams = array();

	/**
	 * @return array
	 */
	public function getDefaultParameters() {
		return $this->defaultParams;
	}

	/**
	 * @param array $params
	 *
	 * @return ClosureMethod
	 */
	public function setDefaultParameters(array $params = array()) {
		$this->defaultParams = $params;
		return $this;
	}

	/**
	 * @param $func
	 *
	 * @return ClosureMethod
	 */
	public function setFunction(callable $func) {
		$this->callable = $func;
		return $this;
	}

	/**
	 * @param $func
	 *
	 * @return ClosureMethod
	 */
	public function setPreCheck(callable $func) {
		$this->preCheckCallable = $func;
		return $this;
	}

	/**
	 * @param $func
	 *
	 * @return ClosureMethod
	 */
	public function setPostCheck(callable $func) {
		$this->postCheckCallable = $func;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function run() {
		$callable = $this->callable;
		return $callable($this->parameters);
	}

	/**
	 * @return AbstractMethod|ClosureMethod
	 */
	public function setup() {
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function preCheck() {
		$callable = $this->preCheckCallable;
		return $callable($this->parameters);
	}

	/**
	 * @return mixed
	 */
	public function postCheck() {
		$callable = $this->postCheckCallable;
		return $callable($this->parameters, $this->value);
	}
}