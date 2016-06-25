<?php
require_once __DIR__.'/index.php';

use Drips\Config\Config;

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

return [
    'propel' => [
        'paths' => [
            'schemaDir' => DRIPS_SRC,
            'phpDir' => DRIPS_SRC,
            'outputDir' => DRIPS_SRC
        ],
        'database' => [
            'connections' => [
                'default' => [
                    'adapter' => Config::get('database_type', 'sqlite'),
                    'dsn' => generatePropelDSN(),
                    'user' => Config::get('database_username', 'root'),
                    'password' => Config::get('database_password', 'root'),
                    'settings' => [
                        'charset' => Config::get('database_charset', 'utf8')
                    ]
                ]
            ]
        ],
        'generator' => [
            'targetPackage' => 'models',
            'schema' => [
                    'autoNamespace' => true
            ],
            'objectModel' => [
                'namespaceMap' => 'models'
            ]
        ],
    ]
];
