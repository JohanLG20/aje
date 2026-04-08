<?php

namespace AJE\Utils;

use AJE\Model\DBArticle;
use AJE\Model\DBBrand;
use AJE\Model\DBFilterType;
use AJE\Model\DBPriceHistory;
use AJE\Model\DBValues_;
use AJE\Model\VFilterValuesAssociations;

class CreateArticlePage
{

    public function __construct()
    {
        
    }

    public function loadArticleInformation(string $id): array
    {
        $dbArticle = new DBArticle;
        $artInfo = $dbArticle->getElementById($id);
        $infos['name'] = $artInfo['article_name'];
        $infos['description'] = $artInfo['description'];

        $dbBrand = new DBBrand();
        $infos['brand'] = $dbBrand->getElementById($artInfo['id_brand'])["brand_label"];

        $dbPrice = new DBPriceHistory();
        $infos['price'] = $dbPrice->getCurrentArticlePrice($id)['price'];

        $infos['filerInfos'] = $this->retriveFilterValues($id);
        $infos['comments'] = $this->retrieveComments($id);

        $infos['id'] = $id;

        return $infos;
    }

    public function prepareAndDisplayView(string $id)
    {
        $articleInfos = $this->loadArticleInformation($id);
        require(LAYOUT . "/header.php");
        require(TEMPLATES . "/articlePage.php");
        require(LAYOUT . "/footer.php");
    }

    public function saveFile(string $fileContent): bool
    {
        return true;
    }

    private function retriveFilterValues(string $id): array
    {
        $dbVal = new DBValues_();
        $allChoices = $dbVal->getAllChoicesForArticle($id);

        $choiceInfos = array();
        $vAssoc = new VFilterValuesAssociations();

        /*We retrieve all the information for each choices
        

        */
        foreach ($allChoices as $choice) {

            $ch = $vAssoc->getAllInfosForId($choice['id_choice_']);
            if (!array_key_exists($ch[0]['id_filter_type'], $choiceInfos)) {
                $choiceInfos[$ch[0]['id_filter_type']]['values'] = array( $ch[0]['filter_value']);
            } else {
                array_push($choiceInfos[$ch[0]['id_filter_type']]['values'],  $ch[0]['filter_value']);
            }
        }

        //Preparing the label
        $dbFiltType = new DBFilterType();
        foreach ($choiceInfos as $key => $infos) {
            $choiceInfos[$key]['label'] = $dbFiltType->getElementById($key, ["filterTypeLabel"])["filter_type_label"];
        }
        
        return $choiceInfos;
    }

    private function retrieveComments(string $idArticle): array
    {
        $dbArticle = new DBArticle();
        $allIdsComments = $dbArticle->getCommentsForArticle($idArticle);

        return $allIdsComments;
    }
}
