<?php
return [
    'doctrine' => [
		'driver' => [
			'pages_entities' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
					'module/Pages/src/Pages/Entity/',
                ],
            ],

            'orm_default' => [
                'drivers' => [
					'Pages\Entity' => 'pages_entities',
                ],
            ],
        ],
    ],
];