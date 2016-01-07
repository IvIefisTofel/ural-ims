<?php

namespace Files;

return [
    'router' => [
        'routes' => [
            'file' => [
                'type'    => 'Segment',
                'options' => [
                    'route'    => '/[:alias]',
                    'defaults' => [
                        'controller' => 'Files\Controller\Index',
                        'action'     => 'index',
                    ],
                    'constraints' => [
                        'alias' => '[\s\S]*',
                    ],
                ],
            ],
        ],
    ],

    'controllers' => [
        'invokables' => [
            'Files\Controller\Index' => Controller\IndexController::class,
        ],
    ],
];