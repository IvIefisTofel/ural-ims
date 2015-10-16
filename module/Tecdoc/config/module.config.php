<?php
return [
    'router' => [
        'routes' => [
            'catalog' => [
                'type' => 'Literal',
                'options' => [
                    'route'    => '/catalog',
                    'defaults' => [
                        'controller' => 'Tecdoc\Controller\Index',
                        'action'     => 'catalog',
                    ],
                ],
            ],
            'models' => [
                'type'    => 'Segment',
                'options' => [
                    'route'    => '/models[/:mfaId]',
                    'constraints' => [
                        'mfaId' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => 'Tecdoc\Controller\Index',
                        'action' => 'models',
                    ],
                ],
            ],
            'cars' => [
                'type'    => 'Segment',
                'options' => [
                    'route'    => '/models/cars[/:modId[/:fuelId]]',
                    'constraints' => [
                        'modId'  => '[0-9]+',
                        'fuelId' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => 'Tecdoc\Controller\Index',
                        'action' => 'cars',
                    ],
                ],
            ],
            'fullInfo' => [
                'type'    => 'Segment',
                'options' => [
                    'route'    => '/models/cars/fullInfo[/:typId]',
                    'constraints' => [
                        'typId'  => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => 'Tecdoc\Controller\Index',
                        'action' => 'fullInfo',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'invokables' => [
            'Tecdoc\Controller\Index' => 'Tecdoc\Controller\IndexController'
        ],
    ],
    'view_manager' => [
        'doctype'                  => 'HTML5',
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
    'doctrine' => [
		'driver' => [
			'tecdoc_entities' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
					'module/Tecdoc/src/Tecdoc/Entity/',
                ],
            ],

            'orm_default' => [
                'drivers' => [
					'Tecdoc\Entity' => 'tecdoc_entities',
                ],
            ],
        ],
    ],
];