<?php return[
    [
        'icon'=>'nav-icon fas fa-tachometer-alt',
        'route'=>'dashboard.dashboard',
        'title'=>'dashboard',
        'active'=>'dashboard.dashboard'
    ],
    [
        'icon'=>'fas fa-tags nav-icon',
        'route'=>'dashboard.categories.index',
        'title'=>'Categories',
        'active'=>'dashboard.categories.*',
        'ability'=>'categories.view'
    ],
    [
        'icon'=>'fas fa-box nav-icon',
        'route'=>'dashboard.products.index',
        'title'=>'Products',
        'active'=>'dashboard.proudcts.*',
        'ability'=>'products.view'
    ],
    [
        'icon'=>'fas fa-receipt nav-icon',
        'route'=>'dashboard.orders.index',
        'title'=>'Orders',
        'active'=>'dashboard.orders.*',
        'ability'=>'orders.view'
    ],
    [
        'icon'=>'fas fa-cogs nav-icon',
        'route'=>'dashboard.roles.index',
        'title'=>'Roles',
        'badge'=>'new',
        'active'=>'dashboard.roles.*',
        'ability'=>'roles.view'
    ],
    [
        'icon'=>'fas fa-users nav-icon',
        'route'=>'dashboard.users.index',
        'title'=>'Users',
        'badge'=>'new',
        'active'=>'dashboard.users.*',
        'ability'=>'users.view'
    ],
    [
        'icon'=>'fas fa-user nav-icon',
        'route'=>'dashboard.admins.index',
        'title'=>'Admins',
        'badge'=>'new',
        'active'=>'dashboard.admins.*',
        'ability'=>'admins.view'
    ],
];