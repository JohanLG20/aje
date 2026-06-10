<?php

namespace AJE\Controller\Backoffice;

use AJE\Model\DBArticle;

class RevenueController
{
    public function show()
    {
        try {
            $dbArticle = new DBArticle();
            $revenuesInfos = $dbArticle->getTotalRevenues();
            $total = $revenuesInfos['revenues'];
            $totalQuantity = $revenuesInfos['total_quantity'];
            $averagePrice = (float) $revenuesInfos['average_price'];
            $averagePrice = round($averagePrice, 2);

            require(VIEW . '/backoffice/revenues.php');
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function permissionDenied()
    {
        require(VIEW . "/404.php");
    }
}
