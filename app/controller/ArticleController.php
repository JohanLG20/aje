<?php

namespace AJE\Controller;

use AJE\Model\DBArticle;
use AJE\Model\DBArticleInformations;

/**
 * Class responsible of gathering the informations in order to display the view of the articles
 * It is reach throught the path ?path=/article/{idArt} and it displays the requested article. It prepares the informations in multiples variable : - array $productInfo -> generic informations such as price, description, name .. It's also where is set if the product has variants or not
 *                                    - string $idArt : The id of the article, used to handdle the basket behavior
 *                                    - array $variants : An array that contains all the variants of the article can be in size, weight ... 
 *                                    - array $commonModalities : Contains all the values that comes from filters but are common to all the other products.
 *                                    
 * 
 */
class ArticleController
{


    
    /**
     * Responsible of the gathering the informations on the product, entry point on ?path=/article/{idArt}. If no article is found, show the 404 page.
     * @param int $idArt The id of the article we want to display
     * 
     */
    public function showVariant(int $idArt)
    {
        try {
            $dbArticle = new DBArticle();

            // On récupère l'id_article_informations lié à cet article
            $idArticleInformations = $dbArticle->getArticleInformationsId($idArt);

            if (!$idArticleInformations) {
                $this->notFound();
                return;
            }

            $dbArticleInformations = new DBArticleInformations();
            $productInfo = $dbArticleInformations->getProductInformations($idArticleInformations);
            $productInfo['price'] = $dbArticle->getArticlePrice($idArt);
            $rawVariants = $dbArticleInformations->getProductVariants($idArticleInformations);

            $formatted   = $this->formatVariants($rawVariants);

            // On extrait les deux parties du résultat
            $commonModalities = $formatted['commonModalities'];
            $variants         = $formatted['variants'];

            $images = $this->retrieveImages($productInfo['image_repertory']);
            $productInfo['imagesPath'] = !empty($images) ? $images : [IMAGE_NOT_FOUND_LINK];
            $commentController = new CommentController();
            $productInfo['canAddComment'] = $commentController->canAddComment($idArt);
            $productInfo['comments'] = $commentController->getComments($idArt);

            // On identifie la variante active pour la mettre en avant dans la vue
            $activeVariant = intval($idArt);

            //If there is more than one variants, then we show them
            $productInfo['hasVariants'] = count($variants) > 1 ? true : false;
            

            require(VIEW . '/articleView.php');
        } catch (\PDOException $e) {
            // TODO: gérer l'erreur
        }
    }

    private function formatVariants(array $rawVariants): array
    {
        $variants = [];

        foreach ($rawVariants as $row) {
            $id = $row['id_article'];

            if (!isset($variants[$id])) {
                $variants[$id] = [
                    'id_article'   => $id,
                    'modalities'   => []
                ];
            }

            if ($row['filter_type_label']) {
                $variants[$id]['modalities'][$row['filter_type_label']] = [
                    'value' => $row['choice_value'],
                ];
            }
        }

        $variants = array_values($variants);

        // On regroupe toutes les valeurs par type de modalité
        $modalitiesByType = [];
        foreach ($variants as $variant) {
            foreach ($variant['modalities'] as $label => $modality) {
                $modalitiesByType[$label][] = $modality['value'];
            }
        }

        // On sépare les modalités communes des modalités variables
        $commonModalities  = [];
        $variantTypes      = [];
        foreach ($modalitiesByType as $label => $values) {
            if (count(array_unique($values)) === 1) {
                // Même valeur pour toutes les variantes → modalité commune
                $commonModalities[$label] = $variants[0]['modalities'][$label];
            } else {
                $variantTypes[] = $label;
            }
        }

        // On ne garde que les modalités variables dans chaque variante
        foreach ($variants as &$variant) {
            $variant['modalities'] = array_filter(
                $variant['modalities'],
                fn($label) => in_array($label, $variantTypes),
                ARRAY_FILTER_USE_KEY
            );
        }

        return [
            'commonModalities' => $commonModalities,
            'variants'         => $variants
        ];
    }

    private function notFound(): void
    {
        http_response_code(404);
        require(VIEW . '/404.php');
    }

    /**
     * Retrieve all the images in the given directory name
     * 
     * @param string $uniqid The directory where the images are stored
     *      * 
     * @return array An array that contains all the paths of the image in the form of
     *  [
     *       [0] => 'fullPathOfImage'
     *  ],
     * ...
     */
    public function retrieveImages(string $uniqid): array
    {
        if (is_dir(ARTICLES_IMAGES . "/" . $uniqid)) {

            $dir = ARTICLES_IMAGES . "/" . $uniqid;
            $allImagesPath = array_diff(scandir($dir), ["..", "."]);
            $allImages = [];

            //Creating the array of path and alt
            foreach ($allImagesPath as $path) {
                $image = IMAGE_LINK . "/" . $uniqid . "/" . $path;
                array_push($allImages, $image);
            }

            return $allImages;
        } else {
            return [];
        }
    }
}
