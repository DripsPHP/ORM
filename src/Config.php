<?php

namespace Drips\ORM;

use Drips\Config\Config;
use Drips\Logger\Logger;
use Drips\Logger\Handler;
use Monolog\Handler\StreamHandler;
use Propel\Common\Config\ConfigurationManager;
use Propel\Runtime\Connection\ConnectionManagerSingle;
use Propel\Runtime\Propel;

abstract class Config
{
    public static function create($config = array(), $adapter = "mysql", $name = "default")
    {
        $logger = new Logger('database_orm');
        $logfile = 'database_orm.log';
        if(defined('DRIPS_LOGS')){
            $logfile = DRIPS_LOGS.'/'.$logfile;
        }
        if(defined('DRIPS_DEBUG')){
            if(DRIPS_DEBUG){
                $logger->pushHandler(new Handler);
            } else {
                $logger->pushHandler(new StreamHandler($logfile, Logger::WARNING));
            }
        }
        $configManager = new ConfigurationManager("propel.php", $config);
        $manager = new ConnectionManagerSingle();
        $manager->setConfiguration($configManager->getConnectionParametersArray()[$name]);
        $manager->setName($name);
        $serviceContainer = Propel::getServiceContainer();
        $serviceContainer->setAdapterClass($name, $adapter);
        $serviceContainer->setConnectionManager($name, $manager);
        $serviceContainer->setDefaultDatasource($name);
        if(Config::get('database_logging', true)){
            $serviceContainer->setLogger($name, $logger);
        }
        if(defined('DRIPS_DEBUG')) {
            if (DRIPS_DEBUG) {
                Propel::getWriteConnection($name)->useDebug(true);
            }
        }
    }
}
