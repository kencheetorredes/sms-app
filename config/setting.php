<?php

return [
    'status' => [
        0 => [
            'label' => 'Inactive',
            'class' => 'text-white bg-danger'
        ],
        1 => [
            'label' => 'Active',
            'class' => 'text-white bg-success'
        ]
    ],
    'message_types' => [
        0 => [
            'label' => 'Contacts',
            'target' => '#contact_div'
        ],
        1 => [
            'label' => 'Group',
            'target' => '#group_div'
        ]
     ],
        'roles' => [
            0 => [
                'label' => 'Admin',
                'class' => 'text-white bg-danger'
            ],
            1 => [
                'label' => 'User',
                'class' => 'text-white bg-success'
            ]
    ]
];