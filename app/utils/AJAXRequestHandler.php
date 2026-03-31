<?php

namespace AJE\Utils;

use AJE\Model\DBCategory;
use AJE\Model\DBChoices;
use AJE\Model\DBFilteredBy;
use AJE\Model\DBFilterType;

class AJAXRequestHandler
{

    public function getDatas(string $table, string $id = "", string $attribute = "")
    {
        try {
            if ($id !== "" && is_numeric($id)) {

                if ($attribute != "") {
                    //If this assumption is true, this means we want to get information on an AssociativeTable
                    if (substr($attribute, 0, 2) === "id") {
                        $datas = TableCorrelation::getCorrelation($table)::getElementsForId($id, $attribute);
                    } else {
                        $datas = TableCorrelation::getCorrelation($table)::getElementById($id)[$attribute] ?? false;
                    }
                } else {
                    $datas = TableCorrelation::getCorrelation($table)::getElementById($id);
                }
            } else {
                $datas = TableCorrelation::getCorrelation($table)::getAllElements();
            }
            if ($datas) {
                $json = json_encode($datas);
                echo $json;
            } else {
                echo 'Données introuvables avec ces paramètres';
            }
        } catch (\PDOException $e) {
            echo "Une erreur s'est produite lors de la requête";
        }
    }

    public function getAllFiltersValueForFilterType(string $id): void
    {
        try {

            if ($id !== "" && is_numeric($id)) {
                //Retrieving all the parents category
                $allCats = DBCategory::getAllParentsIds($id);
                array_push($allCats, $id);
                //Seeking all the filters for the category
                foreach ($allCats as $idCat) {
                    $filts = DBFilteredBy::getElementsForId($idCat, "idCat");
                    //Foreach because some categories may have multiples filter
                    foreach($filts as $filtId){
                        $filters[] = $filtId;
                    }

                }


                foreach ($filters as $filt) {
                    $filterInfos = DBFilterType::getElementById($filt['id_filter_type']);
                    $filterName = DataTransformer::toCamelCase($filterInfos['filter_type_label']);
                    $filterLabel = $filterInfos['filter_type_label'];

                    $datas[$filterName] = [];
                    //Passing the label as the first value of the array
                    $datas[$filterName]['label'] = $filterLabel;

                    $filterValues = DBChoices::getElementsForId($filt['id_filter_type'], "idFilterType");
                    $datas[$filterName]['values'] = $filterValues;
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
        } catch (\PDOException $e) {
            echo "Une erreur s'est produite" . $e->getMessage();
        }
    }
}
