<?php

namespace AJE\Config;

use AJE\Controller\UserManagementController;



abstract class Router
{
    public static function redirect(string $action = "default", bool $isConnected = false)
    {

        $ctlToCall = null;

        switch ($action) {
            case 'login':
                require(CONTROLLER . '/login_ctl.php');
                break;

            case 'signup':
                $ctlToCall = new UserManagementController();
                $ctlToCall->prepareAndDisplayView('create');
                break;

            default:
                require(VIEW . '/firstview_view.php');
        }
    }
}
