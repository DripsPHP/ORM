<?php

use Drips\App;

define('DRIPS_ORM_PROPEL_FILE', __DIR__.'/propel');
define('DRIPS_ORM_PROPEL_CONFIG', __DIR__.'/drips.propel.php');

function generatePropelDSN(){
    $type = Config::get('database_type', 'sqlite');
    $host = Config::get('database_host', DRIPS_SRC.'/database.sqlitedb');
    $port = Config::get('database_port', 3306);
    $db = Config::get('database_name', 'drips');

    $dsn = $type.':';
    if($type == 'sqlite'){
        $dsn .= $host;
    } else {
        $dsn .= 'host=' . $host . ';port=' . $port . 'dbname=' . $db;
    }

    return $dsn;
}

if(class_exists('Drips\App')){
    $drips_propel = __DIR__.'/../../../propel';
    $drips_propel_php = __DIR__.'/../../../propel.php';
    if(DRIPS_DEBUG || !file_exists($drips_propel) || !file_exists($drips_propel_php)){
        copy(DRIPS_ORM_PROPEL_FILE, $drips_propel);
        copy(DRIPS_ORM_PROPEL_CONFIG, $drips_propel_php);
    }
}
