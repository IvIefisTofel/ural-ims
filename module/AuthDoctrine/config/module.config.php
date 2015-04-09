<?php
namespace AuthDoctrine;

$env = getenv('APP_ENV') ?: 'production';

return array(
    'router' => array(
        'routes' => array(
            'admin-login' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/admin/login[/]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'AuthDoctrine\Controller',
                        'controller'    => 'Admin',
                        'action'        => 'login',
                    ),
                ),
                'may_terminate' => true,
            ),
            'logout' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/logout[/]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'AuthDoctrine\Controller',
                        'controller'    => 'Index',
                        'action'        => 'logout',
                    ),
                ),
                'may_terminate' => true,
            ),
		),
	),

    'controllers' => array(
        'invokables' => array(
            'AuthDoctrine\Controller\Index' => 'AuthDoctrine\Controller\IndexController',
            'AuthDoctrine\Controller\Registration' => 'AuthDoctrine\Controller\RegistrationController',
            'AuthDoctrine\Controller\Admin' => 'AuthDoctrine\Controller\AdminController',
        ),
    ),

    'view_manager' => array(
        'display_not_found_reason' => $env == 'development' ? true : false,
        'display_exceptions'       => $env == 'development' ? true : false,
        'template_map' => array(
            'auth/index'           => __DIR__ . '/../view/auth-doctrine/index/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view'
        ),
    ),

    'asset_manager' => array(
        'resolver_configs' => array(
            'paths' => array(
                __DIR__ . '/../public',
            ),
        ),
    ),

    'doctrine' => array(
        'authentication' => array(
            'orm_default' => array(
                'object_manager' => 'Doctrine\ORM\EntityManager',
                'identity_class' => 'AuthDoctrine\Entity\User',
                'identity_property' => 'usrEmail',
                'credential_property' => 'usrPassword',
                'credential_callable' => function(Entity\User $user, $passwordGiven) {
					if ($user->getUsrPassword() == md5($passwordGiven) && $user->getUsrActive() == 1)
						return true;
					else
						return false;
                },
            ),
        ),

		'driver' => array(
			__NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
					__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity',
                ),
            ),

            'orm_default' => array(
                'drivers' => array(
					__NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver',
                )
            )
        )
    ),
);