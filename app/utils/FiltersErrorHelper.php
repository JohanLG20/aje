<?php

namespace AJE\Utils;

use AJE\Model\DBCategory;
use AJE\Model\DBFilteredBy;
use AJE\Model\VFilterValuesAssociations;

class FiltersErrorHelper extends ErrorHelper
{
    //This array is meant to only get the values from filters
    private array $filtersValues = [];
    public function __construct(array $valuesToGet)
    {
        parent::ErrorHelper($valuesToGet); // creating the $this->values
        $this->filtersValues = $this->getFiltersValuesFromPost();
    }

    protected function checkErrors(): array
    {
        try {
            $errors['filtersCat'] = $this->checkFilterForCategory();
            $errors['filtersVal'] = $this->checkValuesForFilter();
            return $errors;
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    private function checkFilterForCategory()
    {
        try {
            $filterByDb = new DBFilteredBy();
            $catDb = new DBCategory();
            //Retrieving the catId and all it's parents
            $allCatIds = $catDb->getCompleteBranch($this->values['idCat']);
            $allFilters = $filterByDb->getAssociatedElementsFromArray("id_filter_type", $allCatIds);


            $allFilters = array_column($allFilters, 'id_filter_type'); //Flattening the array by selecting the id_filter_type column only

            //Checking if the filters ids from $this->values are valid
            if (empty(array_diff($allFilters, array_keys($this->filtersValues)))) {
                return null;
            } else {
                return "Un des types de filtre sélectionné ne convient pas à l'article";
            }
        } catch (\PDOException $e) {
            //TODO : Comment where the error is handdled
            throw $e;
        }
    }
    private function checkValuesForFilter()
    {
        try {
            $fva = new VFilterValuesAssociations();

            $allPossibleValues = $fva->getAllPossibleChoicesForIds(array_keys($this->filtersValues));
            $allPossibleValues = array_column($allPossibleValues, 'id_choice_'); //Flattening the array
            $allValues = array_merge(...$this->filtersValues); //Flattening the array

            //Checking if the filters values are in the possible values
            if(empty(array_diff($allValues, $allPossibleValues))){
                return null;
            }
            else{
                return "Une des valeurs choisis pour le filtre ne correspond pas aux types de filtres autorisés";
            }

            throw new \Exception("not");
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    private function getFiltersValuesFromPost(): array
    {
        $arr = [];
        //Each filter choice sent by post will have numeric key and an array as value
        foreach ($this->values as $key => $val) {
            if (is_numeric($key)) {
                if (is_array($val)) {
                    $arr[$key] = $val;
                }
            }
        }

        return $arr;
    }

}
