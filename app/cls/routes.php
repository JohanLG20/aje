<?php

use AJE\Controller\StaticPageController;
use AJE\Controller\Backoffice\ProductManagementController;
use AJE\Controller\Backoffice\PromotionManagementController;
use AJE\Controller\Backoffice\RevenueController;
use AJE\Controller\UserManagementController;
use AJE\Controller\BasketController;
use AJE\Controller\ArticleController;
use AJE\Controller\PaymentController;
use AJE\Controller\AuthentificationController;
use AJE\Controller\CommentController;
use AJE\Controller\Debug;
use AJE\Controller\SearchPageController;


const ROUTES = [
    '/' => [
        'controller' => StaticPageController::class,
        'method' => 'home'
    ],
    '/usermanagement/{action}' => [
        'controller' => UserManagementController::class,
        'method' => 'prepareAndDisplayView'
    ],
    '/productmanagement/{action}' => [
        'controller' => ProductManagementController::class,
        'method' => 'prepareAndDisplayView',
        'minPermission' => 'admin',
        'denyAccessMethod' => 'permissionDenied'
    ],
    '/promotion/{action}' => [
        'controller' => PromotionManagementController::class,
        'method' => 'prepareAndDisplayView',
        'minPermission' => 'admin',
        'denyAccessMethod' => 'permissionDenied'
    ],

    '/debug/' => [
        'controller' => Debug::class,
        'method' => 'launchDebug',
        'minPermission' => 'admin',
        'denyAccessMethod' => 'permissionDenied'
    ],

    '/filterRequest/getFvForCat/{id}' => [
        'controller' => AJE\Utils\AJAXRequestHandler::class,
        'method' => 'getAllFiltersValueForFilterType'
    ],

    '/article/{idArt}' => [
        'controller' => ArticleController::class,
        'method' => 'showVariant'
    ],
    '/basket/add/{id}' => [
        'controller' => BasketController::class,
        'method' => 'addToBasket'
    ],
    '/basket/remove/{id}' => [
        'controller' => BasketController::class,
        'method' => 'removeFromBasket'
    ],
    '/basket/removeOne/{id}' => [
        'controller' => BasketController::class,
        'method' => 'removeOne'
    ],
    '/revenues/' => [
        'controller' => RevenueController::class,
        'method' => 'show',
        'minPermission' => 'admin',
        'denyAccessMethod' => 'permissionDenied'
    ],

    '/login/' => [
        'controller' => AuthentificationController::class,
        'method' => 'login'
    ],
    '/logout/' => [
        'controller' => AuthentificationController::class,
        'method' => 'logout'
    ],
    '/payment/' => [
        'controller' => PaymentController::class,
        'method' => 'displayPaymentPage',
        'minPermission' => 'client',
        'denyAccessMethod' => 'permissionDenied'
    ],
    '/pay/' => [
        'controller' => PaymentController::class,
        'method' => 'proceedToPayment',
        'minPermission' => 'client',
        'denyAccessMethod' => 'permissionDenied'
    ],
    "/comment/add" => [
        'controller' => CommentController::class,
        'method' => 'addComment',
        'minPermission' => 'client',
        'denyAccessMethod' => 'permissionDenied'
    ],
    "/comment/delete/{idComment}" => [
        'controller' => CommentController::class,
        'method' => 'deleteComment',
        'minPermission' => 'client',
        'denyAccessMethod' => 'permissionDenied'
    ],
    "/comment/modify/{idComment}" => [
        'controller' => CommentController::class,
        'method' => 'modifyComment',
        'minPermission' => 'client',
        'denyAccessMethod' => 'permissionDenied'
    ],
    "/search/{query}" => [
        'controller' => SearchPageController::class,
        'method' => 'displayView'
    ],
    "/contact/" => [
        'controller' => StaticPageController::class,
        'method' => 'showContactPage'
    ],
    "/contact/send" => [
        'controller' => StaticPageController::class,
        'method' => 'sendMessage'
    ],
    "/about/" => [
        'controller' => StaticPageController::class,
        'method' => 'showAboutPage'
    ],

    "/disclaimer/" => [
        'controller' => StaticPageController::class,
        'method' => 'showDisclaimerPage'
    ],
    "/404/" => [
        'controller' => StaticPageController::class,
        'method' => 'show404'
    ],


];
