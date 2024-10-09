<?php

    return [
        [
            'main_icon' => "bx bx-home-circle",
            'main_name'=> "Dashboard",
            'breaker' => "Category",
            'sub_routes' => [
                [
                    'icon' => 'bx bx-right-arrow-alt',
                    'route' => 'admin.dashboard',
                    'title' => 'Main Dashboard'
                ]
            ]

        ],

        [
            'main_icon' => "bx bx-category",
            'main_name'=> "Category",

            'sub_routes' => [
                [
                    'icon' => 'bx bx-right-arrow-alt',
                    'route' => 'admin.categories.index',
                    'title' => 'All Category'
                ],
                [
                    'icon' => 'bx bx-right-arrow-alt',
                    'route' => 'admin.categories.create',
                    'title' => 'Add Category'
                ]

            ]
        ],

        [

        ],
    ];


