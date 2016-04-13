<?php

namespace Drips\ORM;

use Drips\Validator\IValidator;
use Drips\Validator\Validator;
use Drips\Validator\IFilter;
use Drips\Validator\Filter;
use Drips\Validator\validators\Required;

class Attribute
{
    private $name;
    private $primary = false;
    private $validator;
    private $filter;
    private $required = true;
    private $references;
    private $datatype = Datatype::STR;
    private $value;

    public function __construct($name, $datatype = null, $primary = false)
    {
        $this->setName($name);
        if($datatype !== null){
            $this->setDatatype($datatype);
        }
        $this->primary = $primary;
        $this->validator = new Validator;
        $this->filter = new Filter;
    }

    public function setName($name)
    {
        $this->name = strtolower($name);
    }

    public function getName()
    {
        return $this->name;
    }

    public function setDatatype($datatype)
    {
        if(Datatype::isValid($datatype)){
            $this->datatype = $datatype;
        }
    }

    public function getDatatype()
    {
        return $this->datatype;
    }

    public function isRequired($required = null)
    {
        if($required === null){
            return $this->required;
        }
        $this->required = (bool)$required;

        if($this->required){
            $this->validator->addValidator(new Required);
        }
    }

    public function addValidator(IValidator $validator)
    {
        $this->validator->add($validator);
    }

    public function addFilter(IFilter $filter)
    {
        $this->filter->add($filter);
    }

    public function getValidator()
    {
        return $this->validator;
    }

    public function getFilter()
    {
        return $this->filter;
    }

    public function getValue(){
        return $this->value;
    }

    public function setValue($value)
    {
        if(array_product($this->validator->validate($value))){
            $this->setRawValue($value);
            return true;
        }
        return false;
    }

    public function setRawValue($value)
    {
        $this->value = $value;
    }
}
