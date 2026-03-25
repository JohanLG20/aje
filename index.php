<?php

use Dotenv\Dotenv;

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

require("app/cls/config.php");
require(ROOT . '/cls/router.php');

if(isset($_GET['action'])){
    Router::redirect($_GET['action']);
}
else{
    require(VIEW . '/firstview_view.php');
}



?>