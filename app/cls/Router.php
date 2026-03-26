<?php

namespace AJE\Config;

use AJE\Controller\UserManagementController;



abstract class Router
{
    public static function redirect(string $action = "default", string $params = "default", bool $isConnected = false) : void
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

            case 'logout':
                require(CONTROLLER . '/logout.php');
                break;

            case 'backoffice':
                self::rerouteToBackOffice($params);
                break;

            default:
                require(VIEW . '/firstview_view.php');
        }
    }

    private static function rerouteToBackOffice(string $params) : void{

        switch($params){
            case 'prodmanagement':

        }
    }
}
