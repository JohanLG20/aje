<?php

namespace AJE\Controller;

use AJE\Utils\DataTransformer;

abstract class CRUDController
{
    /**
     * Used to check for errors in the post values
     * @param string $action The action currently performed, could be create, update, delete or read
     * @param array $values The values to check
     * 
     * @return array An array containing all the errors and where it occures, or an empty array if there are no errors
     */
    abstract protected function getPostValuesErrors(string $action, array $values): array|bool;

    /**
     * Handdles the error to inform the user on what happened. 
     * @param \Exception $e The error throwed by the database
     * @param string $action The action currently performed, could be create, update, delete or read
     * @param array $values The values that has been used 
     * 
     * @return string The error that happened
     */
    abstract protected function handdleSqlErrors(\Exception $e, string $action, array $values): string;

    /**
     * Function that is in charge to add a new element in the database
     * @param array $params The values to add to the database
     * 
     * @return string A message that will be displayed to the user
     */
    abstract protected function create(array $params): string;

    /**
     * Function that is in charge to update an element in the database
     * @param array $params The values sent to the database
     * 
     * @return string A message that will be displayed to the user
     */
    abstract protected function update(array $params): string;

    /**
     * Function that is in charge to delete an element in the database
     * @param array $params The values sent to the database
     * 
     * @return string A message that will be displayed to the user
     */
    abstract protected function delete(array $params): string;


    /**
     * Preprocess succes message depending on the operation
     * @param string $action The action currently performed, could be create, update, delete or read
     * 
     * @return string A message that tells the user that his operation has been successful
     */
    abstract protected function getSuccessMessage(string $action): string;

    /**
     * Set the title of the page, depending on the action
     * @param string $action The action currently performed, could be create, update, delete or read
     * 
     * @return string The title of the page
     */
    abstract protected function setOperationLabel(string $action): string;


    /**
     * In chage to call the view and passing it the elements it needs in order to display all the content.
     * @param array $view The elements that are needed for the view
     * @param array $values The elements that has been sent through post request
     * 
     */
    abstract protected function callView(array $view, array $values): void;

    /**
     * Use to complete the view informations if needed. These elements will be added to the view array
     * @param string $action The action currently performed, could be create, update, delete or read
     * 
     * @return array An array that contains all the non basics informations the view needs to function.
     */
    abstract protected function completeViewInformations(string $action): array;


    /**
     * This is the skeleton of how a controller will act. You must call this function when you want that your controller performs an action such as create an element, modify it or delete
     * @param string $action The action currently performed, could be create, update, delete or read
     * 
     */
    public function prepareAndDisplayView(string $action)
    {
        //Checking if the asked action are available
        if ($action !== "create" && $action !== "update" && $action !== "delete") {
            require(VIEW . "/404.php");
        } else {
            $view['action'] = $action;

            $values = [];

            $view['operationLabel'] = $this->setOperationLabel($action);

            //A form must have this input in order to be treated
            if (isset($_POST['form_submitted'])) {
                $values = DataTransformer::escapeValues($_POST);

                if (!empty($values)) {

                    $hasErrors = $this->getPostValuesErrors($action, $values);

                    if (!$hasErrors) {
                        $view['operationResult'] = $this->executeOperation($action, $values);
                        $view['form-accepted'] = true;
                    } else {
                        $view['errors'] = $hasErrors;
                    }
                } else {
                    $view['operationResult'] = "Les valeurs entrées ne permettent pas de soumettre ce formulaire";
                }
            }

            $extraInfos = $this->completeViewInformations($action);

            if (!empty($extraInfos)) {
                $view = array_merge($view, $extraInfos); //Adding the extra information to the view array
            }

            $this->callView($view, $values);
        }
    }

    /**
     * Executes the correct method depending on the action that is asked by the user
     * @param string $action The action currently performed, could be create, update, delete or read
     * @param array $values The elements that has been sent through post request
     * 
     * @return string A message that indicates the result of the operation, successful or not
     */
    protected function executeOperation(string $action, array $values): string
    {
        $operationResult = "";
        try {
            switch ($action) {
                case 'create':
                    $operationResult = $this->create($values);
                    break;

                case 'update':
                    $operationResult = $this->update($values);
                    break;

                case 'delete':
                    $operationResult = $this->delete($values);
                    break;
            }
        } catch (\Exception $e) {
            $operationResult = $this->handdleSqlErrors($e, $action, $values);
        } finally {
            return $operationResult;
        }
    }
}
