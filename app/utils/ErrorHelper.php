<?php

namespace AJE\Utils;

abstract class ErrorHelper
{
    abstract protected function checkErrors(): array;
    protected array $values;

    public function ErrorHelper(array $valuesToGet){
        $this->values = $valuesToGet;
    }

    /**
     * Return the error that occured, with the key being where the error happened and the value the error message associated
     * @return array An array of the errors that occured, empty array if no error.
     */
    public function checkForErrors(): array|bool
    {
        $errors = $this->checkErrors(); 
        //We clean all the null values in the array
        foreach ($errors as $key => $val) {
            if (is_null($val)) {
                unset($errors[$key]);
            }
        }

        return !empty($errors) ? $errors : false;
    }
}
