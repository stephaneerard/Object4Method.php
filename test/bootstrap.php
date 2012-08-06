<?php

/** @var $loader \Composer\Autoload\ClassLoader */
$loader = require __DIR__ . '/../vendor/autoload.php';

$loader->addClassMap(array('se\Object4Method\Tests\Dummy\DummyMethod' => __DIR__ . '/se//Dummy/DummyMethod.php'));