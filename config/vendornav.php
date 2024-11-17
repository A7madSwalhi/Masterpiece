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
            'main_name'=> "Product Manage",
            'sub_routes' => [
                [
                    'icon' => 'bx bx-right-arrow-alt',
                    'route' => 'vendor.products.index',
                    'title' => 'All Products'
                ],
                [
                    'icon' => 'bx bx-right-arrow-alt',
                    'route' => 'vendor.products.create',
                    'title' => 'Add Products'
                ],
            ],
        ],
        [
            'main_icon' => "bx bx-category",
            'main_name'=> "Orders Manage",
            'sub_routes' => [
                [
                    'icon' => 'bx bx-right-arrow-alt',
                    'route' => 'vendor.orders.confirmed',
                    'title' => 'Vendor Order'
                ],
                [
                    'icon' => 'bx bx-right-arrow-alt',
                    'route' => 'vendor.orders.all',
                    'title' => 'All Order'
                ],
                [
                    'icon' => 'bx bx-right-arrow-alt',
                    'route' => 'admin.orders.confirmed',
                    'title' => 'Return Order'
                ],
                [
                    'icon' => 'bx bx-right-arrow-alt',
                    'route' => 'admin.orders.processing',
                    'title' => 'Complete Return Order'
                ],
            ],
        ],
    ];



