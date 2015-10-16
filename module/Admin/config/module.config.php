<?php
$env = getenv('APP_ENV') ?: 'production';

return [
    'router' => [
        'routes' => [
            'admin' => [
                'type'    => 'Literal',
                'options' => [
                    'route'    => '/admin',
                    'defaults' => [
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'default' => [
                        'type'    => 'Segment',
                        'options' => [
                            'route'    => '/[:controller[/:action[/:id]]]',
                            'constraints' => [
                                'controller' => 'index|settings|files|pages|users',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'         => '[0-9]+',
                            ],
                            'defaults' => [
                                'controller' => 'Index',
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'forms' => [
                        'type'    => 'Segment',
                        'options' => [
                            'route'    => '/forms[/:action[/:alias]]',
                            'constraints' => [
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'alias'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ],
                            'defaults' => [
                                'controller' => 'forms',
                                'action' => 'index',
                            ],
                        ],
                    ],
                ],
            ],
            'admin-login' => [
                'type'    => 'Segment',
                'options' => [
                    'route'    => '/admin/login',
                    'defaults' => [
                        '__NAMESPACE__' => 'AuthDoctrine\Controller',
                        'controller'    => 'Admin',
                        'action'        => 'login',
                    ],
                ],
                'may_terminate' => true,
            ],
        ],
    ],

    'controllers' => [
        'invokables' => [
            'Admin\Controller\Index' => 'Admin\Controller\IndexController',
            'Admin\Controller\Settings' => 'Admin\Controller\SettingsController',
            'Admin\Controller\Files' => 'Admin\Controller\FilesController',
            'Admin\Controller\Pages' => 'Admin\Controller\PagesController',
            'Admin\Controller\Forms' => 'Admin\Controller\FormsController',
            'Admin\Controller\Users' => 'Admin\Controller\UsersController',
        ],
    ],

    'service_manager' => [
        'abstract_factories' => [
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ],
    ],

    'view_manager' => [
        'display_not_found_reason' => $env == 'development' ? true : false,
        'display_exceptions'       => $env == 'development' ? true : false,
        'doctype'                  => 'HTML5',
        'template_map' => [
            'layout/admin'                  => __DIR__ . '/../view/layout/layout.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],

    'asset_manager' => [
        'resolver_configs' => [
            'collections' => $env == 'development' ? [] : [
                'css/core.css' => [
                    'css/bootstrap.min.css',
                    'css/font-awesome.min.css',
                    'admin/css/plugins/toastr/toastr.css',
                    'admin/css/plugins/gritter/jquery.gritter.css',
                    'admin/css/plugins/iCheck/custom.css',
                    'admin/css/animate.css',
                    'admin/css/inspinia.css',
                    'admin/css/style.css',
                ],
                'js/core.js' => [
                    'js/jquery.min.js',
                    'js/plugins/jQueryUI/jquery-ui.min.js',
                    'js/fixConflictUI.js',
                    'js/bootstrap.min.js',
                    'admin/js/plugins/metisMenu/jquery.metisMenu.js',
                    'admin/js/plugins/slimscroll/jquery.slimscroll.min.js',
                    'admin/js/plugins/flot/jquery.flot.js',
                    'admin/js/plugins/flot/jquery.flot.tooltip.min.js',
                    'admin/js/plugins/flot/jquery.flot.spline.js',
                    'admin/js/plugins/flot/jquery.flot.resize.js',
                    'admin/js/plugins/flot/jquery.flot.pie.js',
                    'admin/js/plugins/peity/jquery.peity.min.js',
                    'admin/js/plugins/gritter/jquery.gritter.min.js',
                    'admin/js/plugins/sparkline/jquery.sparkline.min.js',
                    'admin/js/plugins/chartJs/Chart.min.js',
                    'admin/js/plugins/toastr/toastr.min.js',
                    'admin/js/plugins/iCheck/icheck.min.js',
                    'admin/js/plugins/pace/pace.min.js',
                    'admin/js/inspinia.js',
                ],
            ],
            'paths' => [
                __DIR__ . '/../public',
            ],
        ],
        'filters' => $env == 'development' ? [] : [
            'admin/css/plugins/toastr/toastr.css' => [['filter' => 'CssMinFilter']],
            'admin/css/plugins/gritter/jquery.gritter.css' => [['filter' => 'CssMinFilter']],
            'admin/css/plugins/iCheck/custom.css' => [['filter' => 'CssMinFilter']],
            'admin/css/animate.css' => [['filter' => 'CssMinFilter']],
            'admin/css/inspinia.css' => [['filter' => 'CssMinFilter']],
            'admin/css/style.css' => [['filter' => 'CssMinFilter']],
        ],
        'caching' => $env == 'development' ? [] : [
            'css/core.css' => [
                'cache'     => 'FilesystemCache',
                'options' => [
                    'dir' => './public/css/core',
                ],
            ],
            'js/core.js' => [
                'cache'     => 'FilesystemCache',
                'options' => [
                    'dir' => './public/js/core',
                ],
            ],
        ],
    ],
];