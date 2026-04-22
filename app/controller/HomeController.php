<?php

namespace AJE\Controller;

use AJE\Model\DBArticle;
use AJE\Utils\SaveImageHanddler;

class HomeController
{
    public function home()
    {
        
        $dbArt = new DBArticle();
        $latestArticles = $dbArt->searchForArticles("");
        $latestArticles = SaveImageHanddler::addFirstImageToArray($latestArticles);

        $promotions = $dbArt->getArticlesInPromotions();
        $promotions = SaveImageHanddler::addFirstImageToArray($promotions);


        require(VIEW . '/homePage.php');
    }
}
