<?php
$routes = [
    '' => 'BlogHandler@index',
    'blog' => 'BlogHandler@blog',
    'overview' => 'BlogHandler@overview',
    'admin' => 'AdminHandler@index',
    'edit' => 'AdminHandler@edit',
    'delete' => 'AdminHandler@delete',
    'login' => 'AccountHandler@login',
    'logout' => 'AccountHandler@logout',
    'user' => 'AccountHandler@register'
];
