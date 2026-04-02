<?php

namespace AJE\Utils;

use AJE\Model\DBCategory;
use AJE\Model\DBChoiceColor;

class ProductErrorHelper
{

    public static function checkForErrors(array $values): array|bool
    {
        $errors['articleName'] = self::checkArticleNameErrors($values['articleName']);
        $errors['brand'] = self::checkBrandErrors($values['brand']);
        $errors['description'] = self::checkDescriptionErrors($values['description']);
        $errors['price'] = self::checkPriceErrors($values['price']);
        $errors['idColor'] = self::checkColorErrors($values['idColor']);
        $errors['idCat'] = self::checkCategoryErrors($values['idCat']);
        $errors['brand'] = self::checkBrandErrors($values['brand']);
        //This is quite particular, all the treatement is done in the method
        //Images are stored in $_FILES['images']
        $errors['images'] = self::checkImagesErrors();

        //Checking filters values integrity
        $filterErrorHelper = new FiltersErrorHelper($values);
        $filterErrors = $filterErrorHelper->checkForErrors();

        //Addind the detected errors to the list
        if(!empty($filterErrors)){array_merge($errors, $filterErrors);}



        //We remove all the values that dont have any errors
        foreach ($errors as $key => $val) {
            if (is_null($val)) {
                unset($errors[$key]);
            }
        }

        return !empty($errors) ? $errors : false;
    }

    /**
     * @param string $articleName The name we want to test
     * 
     * @return string|null Return a string that contains the error if one is detected, or null if there are no errors
     */
    private static function checkArticleNameErrors(string $articleName): ?string
    {
        if (strlen($articleName) > 0) {
            if (strlen($articleName) <= 50) {
                return null;
            } else {
                return "Veuillez entrer un nom plus court (50 caractères maximum)";
            }
        } else {
            return "Veuillez entrer un nom pour l'article";
        }
    }

    /**
     * @param string $brand The brand name we want to test
     * 
     * @return string|null Return a string that contains the error if one is detected, or null if there are no errors
     */
    private static function checkBrandErrors(string $brand): ?string
    {
        if (strlen($brand) > 0) {
            if (strlen($brand) <= 50) {
                return null;
            } else {
                return "Veuillez entrer un nom de marque plus court (30 caractères maximum)";
            }
        } else {
            return "Veuillez entrer le nom d'une marque pour l'article";
        }
    }

    /**
     * @param string $description The description we want to test
     * 
     * @return string|null Return a string that contains the error if one is detected, or null if there are no errors
     */
    private static function checkDescriptionErrors(string $description): ?string
    {
        if (strlen($description) > 0) {
            if (strlen($description) <= 255) {
                return null;
            } else {
                return "Veuillez entrer une description plus courte (255 caractères maximum)";
            }
        } else {
            return "Veuillez entrer une description pour l'article";
        }
    }

    private static function checkPriceErrors(string $price) : ?string{
        if(is_numeric($price)){
            if($price > 0 && $price < 9999.99){
                return null;
            }
            else{
                return "Veuillez entrer un prix entre 0 et 9999.99";
            }
        }
        else{
            return "Veuillez entrer le prix sous la forme '99.99'. Pas besoin de préciser la monnaie";
        }
    }

    private static function checkCategoryErrors(string $idCat): ?string
    {
        if (is_numeric($idCat) && $idCat >= 0) {
            $cat = new DBCategory();
            if ($cat->getElementById($idCat)) {
                return null;
            } else {
                return "La catégorie demandée n'est pas disponible";
            }
        } else {
            return 'Veuillez choisir une catégorie';
        }
    }

    private static function checkColorErrors(string $idColor): ?string
    {
        if (is_numeric($idColor) && $idColor >= 0) {
            $col = new DBChoiceColor();
            if ($col->getElementById($idColor)) {
                return null;
            } else {
                return "La couleur demandée n'est pas disponible";
            }
        } else {
            return 'Veuillez choisir une couleur';
        }
    }

    private static function checkImagesErrors() : ?string {
        
        if(isset($_FILES['images']) && !empty($_FILES['images'])){
            //TODO: Insert validation image
            return null;
        }
        else{
            return "Veuillez entrer au moins une image";
        }
    }


}
