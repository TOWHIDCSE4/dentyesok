<?php

return [
    'user' => [
        'user' => [
            'text' => 'User',
            'icon' => 'fa fa-users',
            'route' => '/user',
            'order' => 1,
            'authorize' => ['timetable.index'],
        ],
        'branch' => [
            'text' => 'Branch',
            'icon' => 'fa fa-users',
            'route' => '/branch',
            'order' => 2,
            'authorize' => ['timetable.create'],
        ],
        'employee' => [
            'text' => 'Employee Of Organization ',
            'icon' => 'fa fa-users',
            'route' => '/employee',
            'order' => 3,
            'authorize' => ['timetable.index'],
        ],
        'role' => [
            'text' => 'Role ',
            'icon' => 'fa fa-users',
            'route' => '/role',
            'order' => 4,
            'authorize' => ['timetable.index'],
        ],
        'organization' => [
            'text' => 'Organizations ',
            'icon' => 'fa fa-users',
            'route' => '/organization',
            'order' => 5,
            'authorize' => ['timetable.index'],
        ],
    ]
];