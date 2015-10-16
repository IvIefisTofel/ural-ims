<?php
return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' =>'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => [
                    'host'     => '',                                       // Default 'localhost'
                    'port'     => '',                                       // Default '3306'
                    'user'     => '',                                       // Default 'root'
                    'password' => '',                                       // Default ''
                    'dbname'   => '',                                       // Default 'lit_db'
                    'charset'  => 'utf8',
                    'driverOptions' => [
                        1002 => 'SET NAMES utf8 COLLATE utf8_general_ci'
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'base_path' => '/'                                                  // Default '/'
    ],
];