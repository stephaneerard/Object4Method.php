<?php

class BenchMethodTest extends PHPUnit_Framework_TestCase {

	/**
	 * @param se\Object4Method\ParameterSet $parameters
	 *
	 * @return DummyMethod
	 */
	public function getDummy(array $parameters = NULL) {

		if (NULL === $parameters) {
			$parameters = array('name' => 'coucou');
		}
		$dummy = new \se\Object4Method\Tests\Dummy\DummyMethod();
		$dummy->setParameters($parameters);

		return $dummy;
	}

	/**
	 * @group bench
	 */
	public function testBenchInstanciation() {
		$data = array();
		$global_start = microtime(TRUE);
		foreach(range(1, 10000) as $it) {
			$start = microtime(TRUE);
			$dummy  = $this->getDummy();
			$end = microtime(TRUE);
			$data[] = $end - $start;
		}
		$global_end = microtime(TRUE);


	}
}