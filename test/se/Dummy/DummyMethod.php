<?php

namespace se\Object4Method\Tests\Dummy;

class DummyMethod extends \se\Object4Method\AbstractMethod {

	public function setup() {
		$this->setDefinition(new \se\Object4Method\ParametersDefinitionsSet(array(
			                                                                    new \se\Object4Method\ParameterDefinition('name', function($value) {
				                                                                    return is_string($value) && strlen($value) > 1;
			                                                                    })
		                                                                    ))
		);
	}

	public function getDefaultParameters() {
		return array('name' => 'default');
	}

	public function preCheck() {
		return TRUE;
	}

	public function postCheck() {
		return TRUE;
	}

	public function run() {
		return $this->parameters->get('name');
	}
}