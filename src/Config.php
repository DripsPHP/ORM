<?php

namespace Drips\ORM;

use Propel\Common\Config\ConfigurationManager;
use Propel\Runtime\Connection\ConnectionManagerSingle;
use Propel\Runtime\Propel;

abstract class Config
{
    public static function create($config = array(), $adapter = "mysql", $name = "default")
    {
        $configManager = new ConfigurationManager("propel.php", $config);
        $manager = new ConnectionManagerSingle();
        $manager->setConfiguration($configManager->getConnectionParametersArray()[$name]);
        $manager->setName($name);
        $serviceContainer = Propel::getServiceContainer();
        $serviceContainer->setAdapterClass($name, $adapter);
        $serviceContainer->setConnectionManager($name, $manager);
        $serviceContainer->setDefaultDatasource($name);
    }
}
