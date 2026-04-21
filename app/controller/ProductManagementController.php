<?php

namespace AJE\Controller;

use AJE\Model\DBArticle;
use AJE\Model\DBArticleInformations;
use AJE\Model\DBBrand;
use AJE\Model\DBCategory;
use AJE\Model\DBPriceHistory;
use AJE\Model\DBValues_;
use AJE\Utils\ProductErrorHelper;
use AJE\Utils\SaveImageHanddler;
use AJE\Utils\DataTransformer;
use Exception;

class ProductManagementController extends CRUDController
{

    protected function getPostValuesErrors($action, $values): array|bool
    {
        return ProductErrorHelper::checkForErrors($values, $action);
    }

    protected function create(array $params): string
    {
        try {
            $imageRepertory = uniqid();

            // ----------------- Creating the article informations ------------
            $artInfoDb = new DBArticleInformations();

            $artInfoParams = [
                'article_name' => $params['articleName'],
                'description' => $params['description'],
                'id_category' => $params['idCat'],
                'id_brand' => $params['idBrand'],
                'image_repertory' => $imageRepertory
            ];

            $artInfoDb->addNewElement($artInfoParams);
            $artInfoId = $artInfoDb->getLastAddedElement()['id_article_informations'];


            // -------------- Creating the price history parameter ------------
            $phDb = new DBPriceHistory();
            $phParams = [
                'price' => $params['price']
            ];

            /* ------------- Creating the filters value array ---------------
            * Post format of the fileters values
            *
            * [id_filter_type] => [
            *                    [0] => id_choice_,
            *                    [1] => id_choice_ ...
            *                    ]
            */

            $filterValues = [];
            //Retrieving all the filters and their values
            foreach ($params as $key => $val) {
                //The filter have numeric keys while the other values doesn't
                if (is_numeric($key)) {
                    if (is_array($val)) {
                        $filterValues[$key] = $val;
                    }
                }
            }


            $allFiltersValuesAssociations = DataTransformer::cartesianProduct($filterValues);

            $artDb = new DBArticle();
            $valDb = new DBValues_();
            $allCreatedArticles = []; //Used to create the pages of the new articles

            foreach ($allFiltersValuesAssociations as $val) {
                //Adding the price and the article
                $artDb->addNewElement(["id_article_informations" => $artInfoId]);
                $idLastArticle = $artDb->getLastAddedElement()['id_article'];
                $phParams['id_article'] = $idLastArticle;
                $phDb->addNewElement($phParams);

                //Creating the all the articles
                array_push($allCreatedArticles, $idLastArticle);

                //Adding all the values for each article
                foreach ($val as $filterKey => $choice) {

                    $valDb->addNewElement([
                        'id_article' => $idLastArticle,
                        'id_filter_type' => $filterKey,
                        'id_choice_' => $choice
                    ]);
                }
            }

            //--------------------- Saving the image -------------

            $sih = new SaveImageHanddler($imageRepertory);
            if (!$sih->saveImages($_FILES['images'])) {
                throw new Exception("Impossible de créer la page de l'article");
            }

            //--------------------- Creating the page ---------------
            /*  $cap = new CreateArticlePage();
            $fileContent = $cap->loadArticleInformation($idLastArticle);
            if ($cap->saveFile($fileContent)) {
            } else {
                throw new Exception("Impossible de créer la page de l'article");
            }*/

            return "Article ajouté avec succès";
        } catch (\PDOException $e) {
            return $this->handdleSqlErrors($e, 'create', $params);
        }
    }
    protected function update(array $params): string
    {
        throw new \Exception("Not implemented yet");
    }
    protected function delete(array $params): string
    {
        try{
            $artDb = new DBArticle();
            if($artDb->deleteElementById($params['idArticle'])){
                return "Article supprimé avec succès";
            }else{
                return "Impossible de supprimer l'article";
            }
        }
        catch(\PDOException $e){
            return "Une erreur est survenue lors de l'opération";
        }


    }
    protected function getSuccessMessage(string $action): string
    {
        throw new \Exception("Not implemented yet");
    }
    protected function handdleSqlErrors(\Exception $e, string $action, array $values): string
    {
        return $e->getMessage();
    }
    protected function setOperationLabel(string $action): string
    {
        $operationLabel = "";
        switch ($action) {
            case 'create':
                $operationLabel = "Ajouter un nouveau produit";
                break;
            case 'update':
                $operationLabel = "Modifier un produit déjà existant";
                break;
            case 'delete':
                $operationLabel = "Supprimer un produit";
                break;
        }
        return $operationLabel;
    }

    protected function completeViewInformations(string $action): array
    {
        $catDb = new DBCategory();
        $brandDb = new DBBrand();
        $allCategories = $catDb->getAllElements();
        $allCategories = $this->getCategoryTree($allCategories);
        $extraInformations['categoriesList'] = $this->flattenTree($allCategories);
        $extraInformations['brandList'] = $brandDb->getAllElements();

        if ($action !== "create") {
            $artDb = new DBArticle();
            $allArticles = $artDb->getAllArticlesWithModalities();
            $allArticles = $this->groupArticles($allArticles);
            $extraInformations['articlesList'] = $this->flattenArticlesForSelect($allArticles);
        }


        return $extraInformations;
    }
    protected function callView(array $view, array $values): void
    {
        require(VIEW . '/productManagement_view.php');
    }

    private function getCategoryTree(array $categories): array
    {
        // On indexe par id pour faciliter la recherche
        $indexed = [];
        foreach ($categories as $cat) {
            $indexed[$cat['id_category']] = $cat;
            $indexed[$cat['id_category']]['children'] = [];
        }

        // On construit l'arbre en rattachant chaque enfant à son parent
        $tree = [];
        foreach ($indexed as $id => $cat) {
            if ($cat['id_category_parent_of'] === null) {
                // Catégorie racine
                $tree[] = &$indexed[$id];
            } else {
                // On rattache l'enfant à son parent
                $indexed[$cat['id_category_parent_of']]['children'][] = &$indexed[$id];
            }
        }
        return $indexed;
    }

    /**
     * Aplatit l'arbre en une liste ordonnée avec le niveau de profondeur
     * pour pouvoir l'afficher dans un select
     */
    private function flattenTree(array $tree, int $depth = 0): array
    {
        $result = [];
        foreach ($tree as $node) {
            $result[] = [
                'id_category'          => $node['id_category'],
                'cat_label'            => $node['cat_label'],
                'id_category_parent_of' => $node['id_category_parent_of'],
                'depth'                => $depth
            ];
            if (!empty($node['children'])) {
                $result = array_merge(
                    $result,
                    $this->flattenTree($node['children'], $depth + 1)
                );
            }
        }
        return $result;
    }

    /**
     * @param array $articles
     * 
     * @return array Returns an array with this type of structure
     * [
     *    [
     *       'id_article_informations' => 1,
     *      'article_name'            => 'Sweat à capuche SportFlex',
     *     'variants'                => [23, 24, 25, 26, 27, 28]
     *    ],
     *    [
     *        'id_article_informations' => 2,
     *        'article_name'            => 'Air Jordan 1 Retro High',
     *       'variants'                => [13, 14, 15, 16, 17, 18, 19, 20, 21, 22]
     *    ], 
     *  ...
     * ]
     *  
     */
    public function groupArticles(array $rows): array
    {
        $grouped = [];

        foreach ($rows as $row) {
            $idInfos   = $row['id_article_informations'];
            $idArticle = $row['id_article'];

            if (!isset($grouped[$idInfos])) {
                $grouped[$idInfos] = [
                    'article_name' => $row['article_name'],
                    'variants'     => []
                ];
            }

            if (!isset($grouped[$idInfos]['variants'][$idArticle])) {
                $grouped[$idInfos]['variants'][$idArticle] = [];
            }

            if (!empty($row['filter_type_label']) && !empty($row['choice_value'])) {
                $grouped[$idInfos]['variants'][$idArticle][$row['filter_type_label']] = $row['choice_value'];
            }
        }

        return $grouped;
    }

    public function flattenArticlesForSelect(array $grouped): array
    {
        $result = [];

        foreach ($grouped as $idInfos => $product) {
            $variants = $product['variants'];

            // Produit sans variante
            if (count($variants) === 1) {
                $idArticle = array_key_first($variants);
                $result[] = [
                    'id'       => $idArticle,
                    'label'    => $product['article_name'],
                    'depth'    => 0,
                    'disabled' => false
                ];
                continue;
            }

            // On identifie les modalités qui diffèrent entre les variantes
            $allModalities = [];
            foreach ($variants as $modalities) {
                foreach ($modalities as $label => $value) {
                    $allModalities[$label][] = $value;
                }
            }

            $varyingModalities = [];
            foreach ($allModalities as $label => $values) {
                if (count(array_unique($values)) > 1) {
                    $varyingModalities[] = $label;
                }
            }

            // Produit parent désactivé
            $result[] = [
                'id'       => null,
                'label'    => $product['article_name'],
                'depth'    => 0,
                'disabled' => true
            ];

            // Variantes avec uniquement les modalités qui diffèrent
            foreach ($variants as $idArticle => $modalities) {
                $variantLabel = implode(
                    ' - ',
                    array_filter(
                        array_map(
                            fn($label) => $modalities[$label] ?? null,
                            $varyingModalities
                        )
                    )
                );

                $result[] = [
                    'id'       => $idArticle,
                    'label'    => $product['article_name'] . ' — ' . $variantLabel ?: 'Variante #' . $idArticle,
                    'depth'    => 1,
                    'disabled' => false
                ];
            }
        }

        return $result;
    }

    public function permissionDenied(string $action){
        require (VIEW . "/404.php");
    }
}
