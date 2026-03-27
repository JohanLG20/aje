<?php

namespace AJE\Utils;

class AJAXRequestHandler
{

    public function getDatas(string $table, string $id = "", string $attribute = "")
    {
        try {
            if ($id !== "") {

                if ($attribute != "") {
                    //If this assumption is true, this means we want to get information on an AssociativeTable
                    if (substr($attribute, 0, 2) === "id") {
                        //$attribute = DataTransformer::idToDBFormat($attribute);
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
                echo 'Données introuvable avec ces paramètres';
            }
        } catch (\PDOException $e) {
            echo "Une erreur s'est produite lors de la requête";
        }
    }
}
