<?php
namespace AJE\Controller;

class HomeController{
    public function home() {
        require (VIEW . '/userManagement_view.php');
        
    }
}