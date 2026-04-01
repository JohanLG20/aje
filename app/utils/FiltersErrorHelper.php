<?php

namespace AJE\Utils;

use AJE\Model\DBCategory;
use AJE\Model\DBFilteredBy;
use AJE\Model\VFilterTypeAssociations;
use Exception;

class FiltersErrorHelper extends ErrorHelper
{
    private array $filtersIdsFromPost = [];
    public function __construct(array $valuesToGet)
    {
        parent::ErrorHelper($valuesToGet); // creating the $this->values
        $this->filtersIdsFromPost = $this->getFiltersIdFromValues();
    }

    protected function checkErrors(): array
    {
        try {
            $error['filtersCat'] = $this->checkFilterForCategory();
            $error['filtersVal'] = $this->checkValuesForFilter();
            return $error;
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
            $diff = array_diff($allFilters, $this->filtersIdsFromPost);

            if (empty($diff)) {
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
            $fta = new VFilterTypeAssociations();
        } catch (\PDOException $e) {
        }
    }

    private function getFiltersIdFromValues() : array
    {
        $arr = [];
        //Each filter choice sent by post will have numeric key and an array as value
        foreach ($this->values as $key => $val) {
            if (is_numeric($key)) {
                if (is_array($val)) {
                    array_push($arr, $key);
                }
            }
        }

        return $arr;

    }
}
