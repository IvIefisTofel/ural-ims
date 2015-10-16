<?php
$env = getenv('APP_ENV') ?: 'production';

return [
    'module_layouts' => [
        'Admin' => 'layout/admin',
    ],
    'asset_manager' => [
        'resolver_configs' => [
            'paths' => [
                './public'
            ],
        ],
        'filters' => $env == 'development' ? [] : [
            'application/javascript' => [['filter' => 'JSMin']],
        ],
    ],
];
