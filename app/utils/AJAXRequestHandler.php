<?php

namespace AJE\Utils;

use AJE\Model\DBCategory;
use AJE\Model\DBChoice_;
use AJE\Model\DBFilteredBy;
use AJE\Model\DBFilterType;
use AJE\Model\VFilterValuesAssociations;

class AJAXRequestHandler
{

    public function getAllFiltersValueForFilterType(string $id): void
    {
        if ($id !== "" && is_numeric($id)) {
            try {
                //Retrieving all the parents category
                $catDb = new DBCategory();
                $allCats = $catDb->getCompleteBranch($id);

                //Retrivening the filters for all the category
                $filtByDb = new DBFilteredBy();
                $filters = $filtByDb->getAssociatedElementsFromArray("id_filter_type", $allCats);

                $filterTypeDb = new DBFilterType();
                $fva = new VFilterValuesAssociations();

                /*Creating an array like [FilterLabel => [
                                                     label => postName,
                                                     values => [value1, value2 ...]
                                         ], ...]
                */
                foreach ($filters as $filt) {

                    $filterInfos = $filterTypeDb->getElementById($filt['id_filter_type']);
                    $filterName = $filterInfos['id_filter_type']; //this will be name of the post value
                    $filterLabel = $filterInfos['filter_type_label']; // this will be the label displayed for the filter

                    $datas[$filterName] = [];
                    //Passing the label as the first value of the array
                    $datas[$filterName]['label'] = $filterLabel;
                    //In a second, passing the values to the value part of the array
                    $filterValues = $fva->getChoicesForFilterId($filt['id_filter_type']);
                    $datas[$filterName]['values'] = $filterValues;
                }
            } catch (\PDOException $e) {
                echo "Une erreur s'est produite" . $e->getMessage();
            }
        } else {
            $datas = false;
        }

        if ($datas) {
            $json = json_encode($datas);
            echo $json;
        } else {
            echo 'Données introuvables avec ces paramètres';
        }
    }
}
