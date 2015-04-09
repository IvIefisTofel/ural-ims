<?php
use AuthDoctrine\Entity\User;

return array(
    'acl' => array(
        'roles' => array(
            User::GUEST_ROLE                                => null,
            User::USER_ROLE                                 => User::GUEST_ROLE,
            User::MODERATOR_ROLE                            => User::USER_ROLE,
            User::ADMIN_ROLE                                => User::MODERATOR_ROLE,
        ),
        'resources' => array(
            'allow' => array(
                'Application\Controller\Index' => array(
                    'index'	                                => User::GUEST_ROLE,
                    'test'	                                => User::USER_ROLE,
                ),
                'AuthDoctrine\Controller\Index' => array(
                    'index'	                                => User::GUEST_ROLE,
                    'logout'	                            => User::GUEST_ROLE,
                ),
                'AuthDoctrine\Controller\Admin' => array(
                    'index'	                                => User::GUEST_ROLE,
                    'login'	                                => User::GUEST_ROLE,
                ),
                'Admin\Controller\Index' => array(
                    'index'	                                => User::MODERATOR_ROLE,
                ),
            )
        )
    )
);
