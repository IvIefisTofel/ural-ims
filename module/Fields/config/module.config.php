<?php
return [
    'doctrine' => [
		'driver' => [
			'fields_entities' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
					'module/Fields/src/Fields/Entity/',
                ],
            ],

            'orm_default' => [
                'drivers' => [
					'Fields\Entity' => 'fields_entities',
                ],
            ],
        ],
    ],
];