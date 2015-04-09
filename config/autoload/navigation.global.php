<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */
// from http://framework.zend.com/manual/2.1/en/modules/zend.navigation.quick-start.html
// the array was empty before that
return array(
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Home',
                'route' => 'home',
            ),
            array(
                'label' => 'User',
                'uri'   => '#',
                'pages' => array(
                    array(
                        'label' => 'LogIn',
                        'route' => 'admin-login',
                    ),
                    array(
                        'label' => 'LogOut',
                        'route' => 'logout',
                    ),
                 ),
            ),
            array(
                'label'      => 'Test',
                'route'      => 'test',
                'action'     => 'test',
                'resource'	 => 'Application\Controller\Index',
                'privilege'	 => 'test',
            ),
            array(
                'label' => 'Google',
                'uri'   => 'http://www.google.ru/',
            ),
        ),
        'admin-panel' => array(
            array(
                'label'      => 'Admin',
                'route'      => 'admin',
                'resource'	 => 'Admin\Controller\Index',
                'privilege'	 => 'index',
            ),
            array(
                'label' => 'LogOut',
                'route' => 'logout',
                'resource'	 => 'Admin\Controller\Index',
                'privilege'	 => 'index',
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
            'adminPanel'   => 'Navigator\Navigation\Service\AdminPanelNavigationFactory',
        ),
    ),
);