<?php
use Users\Entity\User;

return [
    'acl' => [
        'roles' => [
            User::GUEST_ROLE                            => null,
            User::USER_ROLE                             => User::GUEST_ROLE,
            User::MODERATOR_ROLE                        => User::USER_ROLE,
            User::ADMIN_ROLE                            => User::MODERATOR_ROLE,
        ],
        'resources' => [
            'allow' => [
                // Authentication
                'AuthDoctrine\Controller\Index' => [
                    User::GUEST_ROLE,
                ],
                'AuthDoctrine\Controller\Admin' => [
                    User::GUEST_ROLE,
                ],
                // Admin
                'Admin\Controller\Index' => [
                    User::MODERATOR_ROLE,
                ],
                'Admin\Controller\Settings' => [
                    'index'	                            => User::MODERATOR_ROLE,
                    'groups'	                        => User::MODERATOR_ROLE,
                    User::ADMIN_ROLE
                ],
                'Admin\Controller\Files' => [
                    User::MODERATOR_ROLE,
                ],
                'Admin\Controller\Pages' => [
                    User::MODERATOR_ROLE,
                ],
                'Admin\Controller\Forms' => [
                    User::MODERATOR_ROLE,
                ],
                'Admin\Controller\Users' => [
                    'index'	                            => User::MODERATOR_ROLE,
                    'editprofile'                       => User::MODERATOR_ROLE,
                    'edituser'                          => User::ADMIN_ROLE,
                ],
                // Client
                'Application\Controller\Index' => [
                    User::GUEST_ROLE,
                ],
                'Tecdoc\Controller\Index' => [
                    User::GUEST_ROLE,
                ],
                'Files\Controller\Index' => [
                    User::GUEST_ROLE,
                ],
            ],
        ],
    ],
];
