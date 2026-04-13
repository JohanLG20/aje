<?php
session_start();
if(isset($_SESSION['showLogin'])) unset($_SESSION['showLogin']);

use AJE\Config\Router;
use Dotenv\Dotenv;

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


require("app/cls/config.php");
new Router;


