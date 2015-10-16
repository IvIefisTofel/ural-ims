<?php
return [
    'doctrine' => [
		'driver' => [
			'user_entities' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
					'module/Users/src/Users/Entity/',
                ],
            ],

            'orm_default' => [
                'drivers' => [
					'Users\Entity' => 'user_entities',
                ],
            ],
        ],
    ],
];