<?php

namespace AJE\Utils;

use AJE\Model\DBArticle;
use AJE\Model\DBBrand;
use AJE\Model\DBFilterType;
use AJE\Model\DBPriceHistory;
use AJE\Model\DBValues_;
use AJE\Model\VFilterValuesAssociations;
use AJE\Controller\CommentController;

class CreateArticlePage
{

    public function __construct() {}

    public function loadArticleInformation(string $id): array
    {
        try {
            $dbArticle = new DBArticle;
            $artInfo = $dbArticle->getElementById($id);
            $infos['name'] = $artInfo['article_name'];
            $infos['description'] = $artInfo['description'];

            $infos['images'] = $this->retrieveImages($artInfo['uniqid'], $infos['name']);

            $dbBrand = new DBBrand();
            $infos['brand'] = $dbBrand->getElementById($artInfo['id_brand'])["brand_label"];

            $dbPrice = new DBPriceHistory();
            $infos['price'] = $dbPrice->getCurrentArticlePrice($id)['price'];

            $infos['filerInfos'] = $this->retriveFilterValues($id);

            $commentController = new CommentController();
            $infos['canAddComment'] = $commentController->canAddComment($id);
            $infos['comments'] = $commentController->getComments($id);

            //We check if an error has occured
            if(isset($infos['comments']['error'])){
                $infos['commentError'] = $infos['comments']['error'];
                unset($infos['comments']['error']); //We unset the variable to not disturb the display of the comments
            }


            $infos['id'] = $id;//TODO: check if still usefull

            return $infos;
        } catch (\Exception) {
            return [];
        }
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
                $choiceInfos[$ch[0]['id_filter_type']]['values'] = array($ch[0]['filter_value']);
            } else {
                array_push($choiceInfos[$ch[0]['id_filter_type']]['values'],  $ch[0]['filter_value']);
            }
        }

        //Preparing the label
        $dbFiltType = new DBFilterType();
        foreach ($choiceInfos as $key => $infos) {
            $choiceInfos[$key]['label'] = $dbFiltType->getElementById($key, ["filter_type_label"])["filter_type_label"];
        }

        return $choiceInfos;
    }


    /**
     * Retrieve all the images in the given directory name
     * 
     * @param string $uniqid The directory where the images are stored
     * 
     * @param string $articleName The name of the article. It will be used for the alt
     * 
     * @return array An array that contains all the paths and the alt of the image in the form of
     * [0] => [
     *         'path' => fullPathOfImage
     *         'alt' => nameOfTheArticle
     *          ]
     */
    public function retrieveImages(string $uniqid, string $articleName): array
    {
        if (is_dir(ARTICLES_IMAGES . "/" . $uniqid)) {

            $dir = ARTICLES_IMAGES . "/" . $uniqid;
            $allImagesPath = array_diff(scandir($dir), ["..", "."]);
            $allImages = [];

            //Creating the array of path and alt
            foreach ($allImagesPath as $path) {
                $image['path'] = IMAGE_LINK . "/" . $uniqid . "/" . $path;
                $image['alt'] = $articleName;
                array_push($allImages, $image);
            }

            return $allImages;
        } else {
            return [];
        }
    }
}
