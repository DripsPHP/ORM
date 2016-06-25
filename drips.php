<?php

use Drips\App;

define('DRIPS_ORM_PROPEL_FILE', __DIR__.'/propel');
define('DRIPS_ORM_PROPEL_CONFIG', __DIR__.'/drips.propel.php');

if(class_exists('Drips\App')){
    $drips_propel = '../../../propel';
    $drips_propel_php = '../../../propel.php';
    if(DRIPS_DEBUG || !file_exists($drips_propel) || !file_exists($drips_propel_php)){
        copy(DRIPS_ORM_PROPEL_FILE, $drips_propel);
        copy(DRIPS_ORM_PROPEL_CONFIG, $drips_propel_php);
    }
}
