<?php
require_once __DIR__.'/index.php';

use Drips\Config\Config;

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
