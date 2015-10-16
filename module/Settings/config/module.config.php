<?php
return [
    'doctrine' => [
		'driver' => [
			'settings_entities' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
					'module/Settings/src/Settings/Entity/',
                ],
            ],

            'orm_default' => [
                'drivers' => [
					'Settings\Entity' => 'settings_entities',
                ],
            ],
        ],
    ],
];