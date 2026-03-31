<?php

const ROUTES = [
    '/' => [
        'controller' => AJE\Controller\ProductManagementController::class,
        'method' => 'home'
    ],
    '/usermanagement/{action}' => [
        'controller' => AJE\Controller\UserManagementController::class,
        'method' => 'prepareAndDisplayView'
    ],
    '/productmanagement/{action}' => [
        'controller' => AJE\Controller\ProductManagementController::class,
        'method' => 'prepareAndDisplayView'
    ],
    '/ajax/{table}' => [
        'controller' => AJE\Utils\AJAXRequestHandler::class,
        'method' => 'getDatas'
    ],
    '/ajax/{table}/{id}' => [
        'controller' => AJE\Utils\AJAXRequestHandler::class,
        'method' => 'getDatas'
    ],
    '/ajax/{table}/{id}/{attribute}' => [
        'controller' => AJE\Utils\AJAXRequestHandler::class,
        'method' => 'getDatas'
    ],

    '/filterRequest/getFvForCat/{id}' => [
        'controller' => AJE\Utils\AJAXRequestHandler::class,
        'method' => 'getAllFiltersValueForFilterType'
    ],

      '/test/' => [
        'controller' => AJE\Model\DBCategory::class,
        'method' => 'test'
    ]

];
