<?php

use Drips\App;
use Drips\ORM\Config;

define('DRIPS_ORM_PROPEL_FILE', __DIR__.'/propel');
define('DRIPS_ORM_PROPEL_CONFIG', __DIR__.'/drips.propel.php');

if(class_exists('Drips\App')){
    $drips_propel = __DIR__.'/../../../propel';
    $drips_propel_php = __DIR__.'/../../../propel.php';
    if(DRIPS_DEBUG || !file_exists($drips_propel) || !file_exists($drips_propel_php)){
        copy(DRIPS_ORM_PROPEL_FILE, $drips_propel);
        copy(DRIPS_ORM_PROPEL_CONFIG, $drips_propel_php);
    }

    Config::create(@include($drips_propel_php));
}
