Object4Method.php
================

by Stéphane Erard <stephane.erard@gmail.com>

What is Object4Method.php ?
---------------------------

Sometimes you come having really big methods.

You now can easily split them into their own objects.

http://www.refactoring.com/catalog/replaceMethodWithMethodObject.html

Requirements
------------

PHP 5.3+

Installation
------------

with Composer :

{
    "repositories": [
        {
            "type": "vcs",
            "url": "http://github.com/stephaneerard/Object4Method.php"
        }
    ],
    "require": {
        "serard/Object4Method": "dev-master"
    }
}

Usage
-----

Before :

``` php
class myBigClass {

    public function myBigMethod($param1, $param2, $param3, $param4, $param5, $param6 = 'default', $param7 = null) {
        //500 lines of code
    }
}
```

After :

``` php
<?php
namespace my\Namespace;

class myLittleShinyClass {

    public function myLittleShinyMethod(array $params = array()) {
        $method = new \my\Namespaced\Method4Object\Class();
        $method->execute($params);
    }
}
```

Defining the Method for Object :

Two options :

Option 1 : Externally Defined object
``` php
<?php

    $method = new \se\Object4Method\ClosureMethod();
    $definitions = new ParametersDefinitionsSet(array(
        new \se\Object4Method\ParameterDefinition('name', function($value) {
                                                                return is_string($value) && strlen($value) > 1;
                                                                //you can throw an exception here
                                                            })
    ));
    $method->setDefinition($definitions);
    $method->setDefaultParameters(array(
        'name' => 'Stéphane Erard'
    ));
    $method->setPreCheck(function($parameters) {
        echo 'pre check';
        return true;
        //you can throw an exception here
    });
    $method->setPostCheck(function($parameters) {
        echo 'post check';
        return true;
        //you can throw an exception here
    });

    $method->execute(array('name' => 'James'));

```

Option 2 : Own-defining Object

    Look at tests/se/Dummy/DummyMethod.php
