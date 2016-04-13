<?php

namespace tests;

use Drips\ORM\Entity;
use Drips\ORM\Attribute;
use Drips\ORM\Datatype;
use PHPUnit_Framework_TestCase;

include __DIR__.'/../vendor/autoload.php';

class UserEntity extends Entity
{
    public function __construct(){
        $this->addAttribute(new Attribute("id", Datatype::INT, true));
        $this->addAttribute(new Attribute("username"));
        $this->addAttribute(new Attribute("email"));
        $this->addAttribute(new Attribute("password"));
    }
}

class EntityTest extends PHPUnit_Framework_TestCase
{
    public function testEntity()
    {
        $user = new UserEntity;
        $this->assertTrue($user instanceof Entity);
        $this->assertTrue($user->isEmpty());
        $user->fill(array(
            "id" => 1,
            "username" => "prowect",
            "email" => "info@prowect.com",
            "password" => "P455W0RD"
        ));
        $this->assertFalse($user->isEmpty());
        $this->assertFalse($user->isModified());
        var_dump($user);
        $user->setEmail("contact@prowect.com");
        $this->assertTrue($user->isModified());
        var_dump($user);
        $userdata = $user->toArray();
        $this->assertEquals($user->getID(), $userdata["id"]);
    }
}
