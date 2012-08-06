<?php

class MethodTest extends PHPUnit_Framework_TestCase {

	/**
	 * @param se\Object4Method\ParameterSet $parameters
	 *
	 * @return DummyMethod
	 */
	public function getDummy(array $parameters = NULL) {

		if(NULL === $parameters) {
			$parameters = array('name' => 'coucou');
		}
		$dummy = new \se\Object4Method\Tests\Dummy\DummyMethod();
		$dummy->setParameters($parameters);

		return $dummy;
	}

	public function testNew() {
		$dummy = $this->getDummy();
		$this->assertInstanceOf('\se\Object4Method\Tests\Dummy\DummyMethod', $dummy);
	}

	public function testResult() {
		$dummy = $this->getDummy();
		$result = $dummy->execute(array('name' => 'hey'))->getValue();

		$this->assertSame('hey', $result);
	}

	public function testError() {
		$this->setExpectedException('InvalidArgumentException', 'Invalid arguments');
		$dummy = $this->getDummy();
		$dummy->execute(array('name' => 'y'))->getValue();
	}
}