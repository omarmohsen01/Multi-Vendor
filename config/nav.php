<?php return[
    [
        'icon'=>'nav-icon fas fa-tachometer-alt',
        'route'=>'admin',
        'title'=>'dashboard',
        'active'=>'dashboard'
    ],
    [
        'icon'=>'fas fa-tags nav-icon',
        'route'=>'admin/categories',
        'title'=>'Categories',
        'active'=>'categories.*',
        'ability'=>'categories.view'
    ],
    [
        'icon'=>'fas fa-box nav-icon',
        'route'=>'admin/products',
        'title'=>'Products',
        'active'=>'proudcts.*',
        'ability'=>'products.view'
    ],
    [
        'icon'=>'fas fa-receipt nav-icon',
        'route'=>'admin/orders',
        'title'=>'Orders',
        'active'=>'orders.*',
        'ability'=>'orders.view'
    ],
    [
        'icon'=>'fas fa-cogs  nav-icon',
        'route'=>'admin/roles',
        'title'=>'Roles',
        'badge'=>'new',
        'active'=>'roles.*',
        'ability'=>'roles.view'
    ],
    [
        'icon'=>'fas fa-users nav-icon',
        'route'=>'admin/users',
        'title'=>'Users',
        'badge'=>'new',
        'active'=>'users.*',
        'ability'=>'users.view'
    ],
    [
        'icon'=>'fas fa-user nav-icon',
        'route'=>'admin/admins',
        'title'=>'Admins',
        'badge'=>'new',
        'active'=>'admins.*',
        'ability'=>'admins.view'
    ],
];