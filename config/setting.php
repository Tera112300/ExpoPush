<?php
return [
    'BcApp' => [
        'adminNavigation' => [
            'Contents' => [
                'ExpoPush' => [
                    'title' => 'プッシュ通知',
                    'type' => 'contents',
                    'url' => [
                        'prefix' => 'Admin',
                        'plugin' => 'ExpoPush',
                        'controller' => 'ExpoPosts',
                        'action' => 'index'
                    ]
                ],
            ]
        ]
    ],
];