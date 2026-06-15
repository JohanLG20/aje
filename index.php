<?php
if (session_status() === PHP_SESSION_NONE) {
    session_name('AJE');
    session_start();
}

require("app/cls/config.php");


use AJE\Config\Router;
use Dotenv\Dotenv;

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

new Router();

//Unsetting the temporary datas of the session
if (isset($_SESSION['showLogin'])) unset($_SESSION['showLogin']);
if (isset($_SESSION['loginError'])) unset($_SESSION['loginError']);
if (isset($_SESSION['showBasket'])) unset($_SESSION['showBasket']);
if (isset($_SESSION['commentError'])) unset($_SESSION['commentError']);
