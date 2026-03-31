<?php

namespace AJE\Utils;

abstract class ErrorHelper
{
    abstract protected function checkErrors(): array;
    protected array $values;

    public function ErrorHelper(array $valuesToGet){
        $this->values = $valuesToGet;
    }

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
