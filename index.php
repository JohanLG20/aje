<?php
session_start();

use AJE\Config\Router;
use Dotenv\Dotenv;

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


require("app/cls/config.php");
new Router;



/*
if (isset($_GET['action'])) {
    if (isset($_GET['params'])) {
        Router::redirect($_GET['action'], $_GET['params']);
    } else {
        Router::redirect($_GET['action']);
    }
} else {
    require(VIEW . '/firstview_view.php');
}*/
