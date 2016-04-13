<?php

namespace Drips\ORM;

class Datatype {
    // STRING
    const TEXT = "string";
    const STRING = "string";
    const STR = "string";

    // INTEGER
    const INTEGER = "int";
    const INT = "int";

    // DECIMAL
    const DECIMAL = "float";
    const FLOAT = "float";
    const DOUBLE = "float";

    // BOOLEAN
    const BOOLEAN = "bool";
    const BOOL = "bool";

    public static function isValid($type)
    {
        return in_array($type, array(self::STR, self::INT, self::FLOAT, self::BOOL));
    }
}
