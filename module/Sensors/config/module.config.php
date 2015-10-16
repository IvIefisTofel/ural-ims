<?php
return [
    'doctrine' => [
		'driver' => [
			'sensors_entities' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
					'module/Sensors/src/Sensors/Entity/',
                ],
            ],

            'orm_default' => [
                'drivers' => [
					'Sensors\Entity' => 'sensors_entities',
                ],
            ],
        ],
    ],
];