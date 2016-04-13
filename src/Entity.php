<?php

namespace Drips\ORM;

abstract class Entity
{
    private $attributes = array();
    protected $modified = false;
    protected $empty = true;

    public function addAttribute(Attribute $attr)
    {
        $this->attributes[$attr->getName()] = $attr;
    }

    public function __call($method, $params = array())
    {
        $matches = array();
        if(preg_match('/^(?<type>(g|s)et)(?<name>\w+)$/i', $method, $matches)){
            array_unshift($params, $matches["name"]);
            return call_user_func_array(array($this, $matches["type"]), $params);
        }
    }

    public function isEmpty()
    {
        return $this->empty;
    }

    public function isModified()
    {
        return $this->modified;
    }

    public function set($name, $value, $raw = false)
    {
        $name = strtolower($name);
        if($this->has($name)){
            if($raw){
                $this->attributes[$name]->setRawValue($value);
                $this->empty = false;
                return true;
            }
            if($this->attributes[$name]->setValue($value)){
                $this->modified = true;
                $this->empty = false;
                return true;
            }
            return false;
        }
        throw new AttributeNotFoundException($name);
    }

    public function get($name)
    {
        $name = strtolower($name);
        if($this->has($name)){
            return $this->attributes[$name]->getValue();
        }
        throw new AttributeNotFoundException($name);
    }

    public function has($name)
    {
        $name = strtolower($name);
        return isset($this->attributes[$name]);
    }

    public function toArray()
    {
        $result = array();
        foreach($this->attributes as $attr)
        {
            $result[$attr->getName()] = $attr->getValue();
        }
        return $result;
    }

    public function __debugInfo()
    {
        return $this->toArray();
    }

    public function fill(array $data)
    {
        foreach($data as $key => $val)
        {
            if($this->has($key)){
                $this->set($key, $val, true);
            }
        }
    }
}
