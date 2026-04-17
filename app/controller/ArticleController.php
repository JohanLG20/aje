<?php

namespace AJE\Controller;

use AJE\Model\DBArticle;
use AJE\Model\DBArticleInformations;
use AJE\Model\DBPriceHistory;

class ArticleController
{
    // Page produit générique — accessible via /article/info/{id_article_informations}
    public function show(int $idArticleInformations): void
    {
        try {
            $dbArticleInformations = new DBArticleInformations();
            $productInfo = $dbArticleInformations->getProductInformations($idArticleInformations);

            if (!$productInfo) {
                $this->notFound();
                return;
            }

            $productInfo['imagesPath'] = $this->retrieveImages($productInfo['image_repertory']);
            $commentController = new CommentController();
            $productInfo['canAddComment'] = $commentController->canAddComment($idArticleInformations);
            $productInfo['comments'] = $commentController->getComments($idArticleInformations);

            $rawVariants = $dbArticleInformations->getProductVariants($idArticleInformations);
            $variants = $this->formatVariants($rawVariants);

            require(VIEW . '/articleView.php');
        } catch (\PDOException $e) {
            // TODO: gérer l'erreur
        }
    }

    // Page variante spécifique — accessible via /article/{id_article}
    public function showVariant(int $idArticle): void
    {
        try {
            $dbArticle = new DBArticle();

            // On récupère l'id_article_informations lié à cet article
            $idArticleInformations = $dbArticle->getArticleInformationsId($idArticle);

            if (!$idArticleInformations) {
                $this->notFound();
                return;
            }

            $dbArticleInformations = new DBArticleInformations();
            $productInfo = $dbArticleInformations->getProductInformations($idArticleInformations);
            $productInfo['price'] = $dbArticle->getArticlePrice($idArticle);
            $rawVariants = $dbArticleInformations->getProductVariants($idArticleInformations);
            $formatted = $this->formatVariants($rawVariants);

            // On extrait les deux parties du résultat
            $commonModalities = $formatted['commonModalities'];
            $variants         = $formatted['variants'];


            $productInfo['imagesPath'] = $this->retrieveImages($productInfo['image_repertory']);
            $commentController = new CommentController();
            $productInfo['canAddComment'] = $commentController->canAddComment($idArticleInformations);
            $productInfo['comments'] = $commentController->getComments($idArticleInformations);

            // On identifie la variante active pour la mettre en avant dans la vue
            $activeVariant = array_filter(
                $variants,
                fn($v) => $v['id_article'] === $idArticle
            );
            $activeVariant = array_values($activeVariant)[0] ?? null;

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
                    'hexa'  => $row['color_choice_hexa'] ?? null
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
