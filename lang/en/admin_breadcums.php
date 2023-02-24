<?php
return [
    'dashboard' => [
        'page_name' => 'Dashboard',
        'breadcums' => [
            ['name' => 'Dashboard', 'url' => ''],
        ],
    ],
    'settings' => [
        'index' => [
            'page_name' => 'Settings',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'Settings', 'url' => ''],
            ],
        ],
        'create' => [
            'page_name' => 'Settings',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'Settings', 'url' => 'admin.settings.index'],
                ['name' => 'Create', 'url' => ''],
            ],
        ],
        'edit' => [
            'page_name' => 'Settings',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'Settings', 'url' => 'admin.settings.index'],
                ['name' => 'Edit  ', 'url' => ''],
            ],
        ],
        'group' => [
            'page_name' => 'Settings',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'Settings', 'url' => 'admin.settings.index'],
                ['name' => '', 'url' => ''],
            ],
        ],
    ],
    'modules' => [
        'index' => [
            'page_name' => 'Modules',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'Modules', 'url' => ''],
            ],
        ],
        'create' => [
            'page_name' => 'Modules',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'Modules', 'url' => 'admin.modules.index'],
                ['name' => 'Create', 'url' => ''],
            ],
        ],
        'edit' => [
            'page_name' => 'Modules',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'Modules', 'url' => 'admin.modules.index'],
                ['name' => 'Edit  ', 'url' => ''],
            ],
        ],
    ],
];
