<?php

abstract class Router{
    public static function redirect (string $action = "default", bool $isConnected = false){      

        switch($action){
            case 'login':
                require(CONTROLLER . '/login_ctl.php');
                break;

            case 'signup':
                require(CONTROLLER . '/signup_ctl.php');
                break;
                
            default:
                require(VIEW . '/firstview_view.php');
        }
    }
}