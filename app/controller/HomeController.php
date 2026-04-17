<?php

namespace AJE\Controller;

use AJE\Model\DBArticle;
use AJE\Utils\SaveImageHanddler;

class HomeController
{
    public function home()
    {
        $dbArt = new DBArticle();
        $latestArticles = $dbArt->searchForArticle("Basket");
        $latestArticles = $this->addImages($latestArticles);

        $promotions = $dbArt->getArticlesInPromotions();
        $promotions = $this->addImages($promotions);

        //We use the index to modify the array by referencing it
        foreach ($latestArticles as $index => $la) {
            $image = SaveImageHanddler::getFirstImage($la['image_repertory']);
            $latestArticles[$index]['image'] = $image ?? IMAGE_NOT_FOUND_LINK;
        }

        require(VIEW . '/homePage.php');
    }

    private function addImages(array $arr): array
    {
        //We use the index to modify the array by referencing it
        foreach ($arr as $index => $la) {
            $image = SaveImageHanddler::getFirstImage($la['image_repertory']);
            $arr[$index]['image'] = $image ?? IMAGE_NOT_FOUND_LINK;
        }

        return $arr;
    }
}
