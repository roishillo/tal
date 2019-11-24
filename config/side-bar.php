<?php

return [
	'dashboard' => [
		'route' => 'admin.dashboard',
		'display' => 'admin.sidebar.dashboard',
		'icon' => 'fa fa-info',
        'authenticate' => ['Admin', 'Helper', 'Site Builder']
    ],
    'educands-management' => [
        'route' => 'admin.educands-management.index',
        'display' => 'admin.sidebar.educands-management',
        'icon' => 'fa fa-book',
        'authenticate' => ['Admin','Helper']
    ],
    'admins-management' => [
        'route' => 'admin.admins-management.index',
        'display' => 'admin.sidebar.admins-management',
        'icon' => 'fa fa-key',
        'authenticate' => ['Admin','Helper', 'Site Builder']
    ],

	'file-manager' => [
		'route' => 'filemanager.main',
		'display' => 'admin.sidebar.file-manager',
		'icon' => 'fa fa-cloud',
        'authenticate' => ['Admin','Site Builder','Helper']
	],
    'sites-management' => [
        'route' => 'admin.sites-management.index',
        'display' => 'admin.sidebar.sites-management',
        'icon' => 'fa fa-building',
        'authenticate' => ['Admin','Helper','Site Builder']
    ],
    'tasks-management' => [
        'route' => 'admin.tasks-management.index',
        'display' => 'admin.sidebar.tasks-management',
        'icon' => 'fa fa-clipboard-list',
        'authenticate' => ['Admin','Helper', 'Site Builder']
    ],
    'tracks-management' => [
        'route' => 'admin.tracks-management.index',
        'display' => 'admin.sidebar.tracks-management',
        'icon' => 'fa fa-list-ol',
        'authenticate' => ['Admin','Helper']
    ],


];