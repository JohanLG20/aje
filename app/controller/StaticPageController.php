<?php

namespace AJE\Controller;

use AJE\Model\DBArticle;
use AJE\Utils\ImageHanddler;

class StaticPageController
{

    /**
     * Function that displays the home page, accessed by the route /
     */
    public function home()
    {

        $dbArt = new DBArticle();
        $ih = new ImageHanddler();
        $latestArticles = $dbArt->getLatestArticles();

        //Adding the images to the latest article
        foreach ($latestArticles as &$art) {
            $art['image'] = $ih->getFirstImage($art['image_repertory']);
        }

        $promotions = $dbArt->getArticlesInPromotions();

        //Adding the images to the related article
        foreach ($promotions as &$art) {
            $art['image'] = $ih->getFirstImage($art['image_repertory']);
        }


        require(VIEW . '/homePage.php');
    }

    /**
     * Function that displays the contact page, accessed by the route /contact/
     */
    public function showContactPage()
    {
        require(VIEW . "/contactPage.php");
    }

    /**
     * Function that displays the about page, accessed by the route /about/
     */
    public function showAboutPage()
    {
        require(VIEW . "/aboutPage.php");
    }

    /**
     * Function that displays the disclaimer page, accessed by the route /disclaimer/
     */
    public function showDisclaimerPage()
    {
        require(VIEW . "/disclaimerPage.php");
    }

    /**
     * Function that displays the 404 page, accessed by the route /404/
     */
    public function show404()
    {
        require(VIEW . "/404.php");
    }
}
