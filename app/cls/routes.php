<?php

const ROUTES = [
    '/' => [
        'controller' => AJE\Controller\HomeController::class,
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
    '/article/info/{idArticleInformations}' => [
        'controller' => AJE\Controller\ArticleController::class,
        'method' => 'show'
    ],

    '/article/{idArticle}' => [
        'controller' => AJE\Controller\ArticleController::class,
        'method' => 'showVariant'
    ],
    'basket/add/{id}' => [
        'controller' => AJE\Controller\BasketController::class,
        'method' => 'addToBasket'
    ],
    'basket/remove/{id}' => [
        'controller' => AJE\Controller\BasketController::class,
        'method' => 'removeFromBasket'
    ],
    '/login/' => [
        'controller' => AJE\Controller\AuthentificationController::class,
        'method' => 'login'
    ],
    '/logout/' => [
        'controller' => AJE\Controller\AuthentificationController::class,
        'method' => 'logout'
    ],
    '/payment/' => [
        'controller' => AJE\Controller\PaymentController::class,
        'method' => 'displayPaymentPage',
        'minPermission' => 'client',
        'denyAccessMethod' => 'permissionDenied'
    ],
    '/pay/' => [
        'controller' => AJE\Controller\PaymentController::class,
        'method' => 'proceedToPayment',
        'minPermission' => 'client',
        'denyAccessMethod' => 'permissionDenied'
    ],
    "/addComment/" => [
        'controller' => AJE\Controller\CommentController::class,
        'method' => 'addComment',
        'minPermission' => 'client',
        'denyAccessMethod' => 'permissionDenied'
    ],
    "/deleteComment/{idComment}" => [
        'controller' => AJE\Controller\CommentController::class,
        'method' => 'deleteComment',
        'minPermission' => 'client',
        'denyAccessMethod' => 'permissionDenied'
    ],
    "/edit/{idComment}" => [
        'controller' => AJE\Controller\CommentController::class,
        'method' => 'deleteComment',
        'minPermission' => 'client',
        'denyAccessMethod' => 'permissionDenied'
    ],
    "/search/{query}" => [
        'controller' => AJE\Controller\SearchPageController::class,
        'method' => 'displayView',
    ],



    //TODO: Add contact page + validation RGPD

];
