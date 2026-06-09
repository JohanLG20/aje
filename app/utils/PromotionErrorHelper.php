<?php

namespace AJE\Utils;

class PromotionErrorHelper
{

    public static function checkForErrors(array $values, string $action): array|bool
    {
        $errors['idArticle'] = self::checkForIdArticleErrors($values['idArticle']);
        $errors['startDate'] = self::checkForStartDateErrors($values['startDate']);
        $errors['endDate'] = self::checkForEndDateErrors($values['startDate'], $values['endDate']);
        $errors['price'] = self::checkForPriceErrors($values['price']);

        foreach ($errors as $key => $val) {
            if (is_null($val)) {
                unset($errors[$key]);
            }
        }
        return !empty($errors) ? $errors : false;
    }

    /**
     * @param string $id The article id's we want to test
     * 
     * @return string|null Returns null if there are no errors or a string that contains the error
     */
    private static function checkForIdArticleErrors(string $id): ?string
    {
        if (is_numeric($id)) {
            return null;
        } else {
            return "Veuillez sélectionner un article dans la liste";
        }
    }

    /**
     * @param string $startDate The start date we want to test
     * 
     * @return string|null Returns null if there are no errors or a string that contains the error
     */
    private static function checkForStartDateErrors(string $startDate): ?string
    {
        if (date_parse($startDate)) {
            return null;
        } else {
            return "Veuillez sélectionner une date de début";
        }
    }

    /**
     * @param string $startDate The start date we want to test
     * @param string $endDate The end date we want to test
     * 
     * @return string|null Returns null if there are no errors or a string that contains the error
     */
    private static function checkForEndDateErrors(string $startDate, string $endDate): ?string
    {
        if (date_parse($startDate) && date_parse($endDate)) {
            if (strtotime($startDate) < strtotime($endDate)) {
                return null;
            } else {
                return "Veuillez sélectionner une date de fin postérieure à la date de début";
            }
        } else {
            return "Veuillez sélectionner une date de fin";
        }
    }

    /**
     * @param string $price The price we want to test
     * 
     * @return string|null Returns null if there are no errors or a string that contains the error
     */
    private static function checkForPriceErrors(string $price): ?string
    {
        if (is_numeric($price)) {
            return null;
        } else {
            return "Veuillez entrer un prix";
        }
    }
}
