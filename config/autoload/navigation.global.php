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
return [
    'navigation' => [
        'default' => [
            [
                'label' => 'Главная',
                'scroll' => 'home',
                'route' => 'home',
            ],
            [
                'label' => 'О нас',
                'scroll' => 'about-us',
                'uri' => '/#',
                'skip' => true,
            ],
            [
                'label' => 'Механообработка',
                'scroll' => 'machining',
                'route' => 'machining',
            ],
            [
                'label' => 'Литье пластмасс',
                'scroll' => 'plastic',
                'route' => 'plastic',
            ],
            [
                'label' => 'Контакты',
                'route' => 'contacts',
            ],
        ],
        'admin-panel'   => [
            [
                'label'     => 'Главная',
                'route'     => 'admin',
                'resource'	=> 'Admin\Controller\Index',
                'privilege'	=> 'index',
                'icon'      => 'fa fa-th-large',
            ],
            [
                'label'     => 'Настройки',
                'uri'       => '#',
                'icon'      => 'fa fa-cogs',
                'pages'     => [
                    [
                        'label'      => 'Параметры',
                        'route'      => 'admin/default',
                        'controller' => 'settings',
                        'action'     => 'index',
                        'icon'       => 'fa fa-th-list',
                        'resource'	 => 'Admin\Controller\Settings',
                        'privilege'	 => 'index',
                    ],
                    [
                        'label'      => 'Группы параметров',
                        'route'      => 'admin/default',
                        'controller' => 'settings',
                        'action'     => 'groups',
                        'icon'       => 'fa fa-group',
                        'resource'	 => 'Admin\Controller\Settings',
                        'privilege'	 => 'index',
                    ],
                ],
            ],
            [
                'label'      => 'Страницы',
                'route'      => 'admin/default',
                'controller' => 'pages',
                'icon'       => 'fa fa-television',
                'resource'	 => 'Admin\Controller\Pages',
                'privilege'	 => 'index',
            ],
            [
                'label'      => 'Формы',
                'route'      => 'admin/forms',
                'icon'       => 'fa fa-list-alt',
                'resource'	 => 'Admin\Controller\Forms',
                'privilege'	 => 'index',
            ],
            [
                'label'     => 'Файлы',
                'uri'       => '#',
                'icon'      => 'fa fa-folder-open',
                'pages'     => [
                    [
                        'label'      => 'Все файлы',
                        'route'      => 'admin/default',
                        'controller' => 'files',
                        'action'     => 'index',
                        'icon'       => 'fa fa-files-o',
                        'resource'	 => 'Admin\Controller\Files',
                        'privilege'	 => 'index',
                    ],
                    /*[
                        'label'      => 'Изображения',
                        'route'      => 'admin/default',
                        'controller' => 'files',
                        'action'     => 'images',
                        'icon'       => 'fa fa-picture-o',
                        'resource'	 => 'Admin\Controller\Files',
                        'privilege'	 => 'index',
                    ],*/
                ],
            ],
            [
                'label'      => 'Пользоватли',
                'route'      => 'admin/default',
                'controller' => 'users',
                'icon'       => 'fa fa-male',
                'pages'     => [
                    [
                        'label'      => 'Все пользователи',
                        'route'      => 'admin/default',
                        'controller' => 'users',
                        'icon'       => 'fa fa-users',
                        'resource'	 => 'Admin\Controller\Users',
                        'privilege'	 => 'index',
                    ],
                    [
                        'label'      => 'Ваш профиль',
                        'route'      => 'admin/default',
                        'controller' => 'users',
                        'action'     => 'editprofile',
                        'icon'       => 'fa fa-user',
                        'resource'	 => 'Admin\Controller\Users',
                        'privilege'	 => 'index',
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
            'adminPanel' => 'Navigator\Navigation\Service\AdminPanelNavigationFactory',
            'dbNavigation' => 'Navigator\Navigation\Service\DbNavigationFactory',
        ],
    ],
];