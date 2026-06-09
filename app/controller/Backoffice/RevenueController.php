<?php

namespace AJE\Controller\Backoffice;

use AJE\Model\DBArticle;

class RevenueController
{
    public function show()
    {
        try {
            $dbArticle = new DBArticle();

            $revenues = $dbArticle->getTotalRevenues();
            require(LAYOUT . '/header.php');
            var_dump($revenues);
            require(LAYOUT . '/footer.php');
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function permissionDenied(string $action)
    {
        require(VIEW . "/404.php");
    }
}
