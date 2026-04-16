<?php

namespace AJE\Controller;

use AJE\Model\DBArticle;
use AJE\Model\DBArticleInformations;
use AJE\Model\DBBrand;
use AJE\Model\DBPriceHistory;
use PDOException;

/**
 * [Description BasketController]
 * This is the controller for the basket. It can add, or remove but also gathering informations
 * for the layout. All it's value will be stock int the $_SESSION['basket'] array which has a form of :
 * $_SESSION['basket'] =>[
 *                  [idArticle1] =>[
 *                      'quantity' => 1
 *                      'image' => imagePath
 *                      'name' => nameOfArticle
 *                      'price' => priceOfArticle
 *     '                 error' => //Filled with string if an error occured or null if not
 *                          ]
 *                      ],
 *                  [idArticle2] => ...
 *                  ]
 *
 */
class BasketController
{
    private ?array $articles;

    public function __construct()
    {
        $this->articles = $_SESSION['basket'] ?? null;
    }

    /**
     * @return array|null Return null if there are no articles, the articles list if there are
     */
    public function getArticles(): array|null{
        return $this->articles;
    }
    /**
     * Add an article to the basket. If there already is an occurence of this article, add one to the quantity. Else, create the line.
     * @param string $id The id of the article we want to add
     * 
     */
    public function addToBasket(string $id)
    {
        //Creating the session value
        if (!isset($_SESSION['basket'])) {
            $_SESSION['basket'] = [];
        }

        if (array_key_exists($id, $_SESSION['basket'])) {
            $_SESSION['basket'][$id]['quantity']++;
        } else {
            $_SESSION['basket'][$id] = $this->createBasketItem($id);
        }

        header("Location: {$_SERVER['HTTP_REFERER']}");
    }

    /**
     * Remove an article to the basket.
     * @param string $id The id of the article we want to remove
     * 
     */
    public function removeFromBasket(string $id)
    {
        unset($_SESSION['basket'][$id]);
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }

    /**
     * Unset the variable $_SESSION['basket']
     */
    public function resetBasket(){
        unset($_SESSION['basket']);
    }

    /**
     * Return an array in the form of
     * [
     *  'quantity' => 1
     *  'image' => imagePath
     *  'name' => nameOfArticle
     *  'price' => priceOfArticle
     *  'error' => //Filled with string if an error occured or null if not
     * ]
     * 
     *
     * @param string $id The id of the article added in the basket
     * 
     * @return array An array with the informations of the given article
     */
    private function createBasketItem(string $id): array
    {
        try {
            //For now, we can only add one article when creating the item
            $basket['quantity'] = 1;

            $dbArticle = new DBArticle();
            $idArtInfo = $dbArticle->getElementById($id)['id_article_informations'];
            $dbArtInfo = new DBArticleInformations();
            $articleInfos = $dbArtInfo->getElementById($idArtInfo);

            //Placing the article name
            $basket['name'] = $articleInfos['article_name'];

            //Retrieving the price
            $basket['price'] = $dbArticle->getArticlePrice($id);

            //Retrieving the principal image
            $basket['image'] = $this->getBasketImage($articleInfos['image_repertory']);

            return $basket;
        } catch (PDOException $e) {
            $basket['error'] = "Une erreur est survenue lors de l'ajout de l'article";
            return $basket;
        }
    }

    /**
     *  Note : The image path returned will be the first one in alphabetic order. If a modification of the images naming pattern is done, this function has to be updated too.
     * @param string $uniqid The uniqid where the image is stored
     * 
     * @return string The path to the image
     */
    private function getBasketImage(string $uniqid): string
    {

        if (is_dir(ARTICLES_IMAGES . "/" . $uniqid)) {

            $dir = ARTICLES_IMAGES . "/" . $uniqid;
            $allImagesPath = array_diff(scandir($dir), ["..", "."]);

            print_r($allImagesPath);

            $image = IMAGE_LINK . "/" . $uniqid . "/" . $allImagesPath[2];
            var_dump($allImagesPath);
            return $image;
        } else {
            return ""; //TODO: add non found image path
        }
    }
}
