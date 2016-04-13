<?php

namespace tests;

use Drips\ORM\Attribute;
use Drips\ORM\Datatype;
use PHPUnit_Framework_TestCase;

include __DIR__.'/../vendor/autoload.php';

class AttributeTest extends PHPUnit_Framework_TestCase
{
    public function testAttribut()
    {
        $name = "userid";
        $type = Datatype::INT;
        $attribute = new Attribute($name, $type);
        $this->assertEquals($attribute->getName(), $name);
        $this->assertEquals($attribute->getDatatype(), $type);
        $this->assertTrue($attribute->isRequired());
        $attribute->isRequired(false);
        $this->assertFalse($attribute->isRequired());

        $name = "firstname";
        $attribute = new Attribute($name);
        $this->assertEquals($attribute->getName(), $name);
    }
}
