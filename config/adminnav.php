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
            'main_name'=> "Brands",

            'sub_routes' => [
                [
                    'icon' => 'bx bx-right-arrow-alt',
                    'route' => 'admin.brands.index',
                    'title' => 'All brands'
                ],
                [
                    'icon' => 'bx bx-right-arrow-alt',
                    'route' => 'admin.brands.create',
                    'title' => 'Add Brand'
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
            'main_icon' => "bx bx-category",
            'main_name'=> "Product Manage",
            'sub_routes' => [
                [
                    'icon' => 'bx bx-right-arrow-alt',
                    'route' => 'admin.products.index',
                    'title' => 'All Products'
                ],
                [
                    'icon' => 'bx bx-right-arrow-alt',
                    'route' => 'admin.products.create',
                    'title' => 'Add Products'
                ],
            ],
        ],
        [
            'main_icon' => "bx bx-category",
            'main_name'=> "Coupons System",
            'sub_routes' => [
                [
                    'icon' => 'bx bx-right-arrow-alt',
                    'route' => 'admin.coupons.index',
                    'title' => 'All Coupons'
                ],
                [
                    'icon' => 'bx bx-right-arrow-alt',
                    'route' => 'admin.coupons.create',
                    'title' => 'Add Coupon'
                ],
            ],
        ],
    ];



