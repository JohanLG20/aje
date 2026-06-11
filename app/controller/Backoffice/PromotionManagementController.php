<?php

namespace AJE\Controller\Backoffice;

use AJE\Model\DBArticle;
use AJE\Model\DBPriceHistory;
use Exception;
use AJE\Utils\PromotionErrorHelper;
use AJE\Controller\CRUDController;

class PromotionManagementController extends CRUDController
{
    protected function getPostValuesErrors($action, $values): array|bool
    {
        return PromotionErrorHelper::checkForErrors($values, $action);
    }
    protected function handdleSqlErrors(\Exception $e, string $action, array $values): string
    {
        return $e->getMessage();
    }

    protected function create(array $params): string
    {
        try{
            $phDb = new DBPriceHistory();
            $sqlParams = [
                "id_article" => $params['idArticle'],
                "start_date" => $params['startDate'],
                "end_date" => $params['endDate'],
                "price" => $params['price']
            ];
            $phDb->addNewElement($sqlParams);
            return $this->getSuccessMessage("create");
        
        }
        catch(\Exception $e){
            throw $e;
        }

    }

    protected function update(array $params): string
    {
        throw new Exception("Not implemented yet");
    }

    protected function delete(array $params): string
    {
        throw new Exception("Not implemented yet");
    }

    protected function getSuccessMessage(string $action): string
    {
        $successMessage = "";

        switch ($action) {
            case 'create':
                $successMessage = "La promotion à bien été ajoutée";
                break;

            case 'update':
                $successMessage = "La promotion à bien été modifiée";
                break;
        }

        return $successMessage;
    }

    protected function setOperationLabel(string $action): string
    {
        $label = "";

        switch ($action) {
            case 'create':
                $label = "Ajouter une promotion";
                break;

            case 'update':
                $label = "Modifier une promotion";
                break;
        }

        return $label;
    }

    protected function callView(array $view, array $values): void
    {
        require(VIEW . "/backoffice/promotionPage.php");
    }

    protected function completeViewInformations(string $action): array
    {
        if ($action !== "create") {
        }

        $artDb = new DBArticle();
        $artCtl  = new ProductManagementController();

        $artList = $artDb->getAllArticlesWithModalities();
        $artList = $artCtl->groupArticles($artList);
        $view['articlesList'] = $artCtl->flattenArticlesForSelect($artList);

        return $view;
    }

        public function permissionDenied(string $action){
        require (VIEW . "/404.php");
    }
}
