<?php

namespace AJE\Utils;

abstract class ErrorHelper
{
    abstract protected function checkErrors(array $value): array;
    private array $values;

    public function checkForErrors(): array|bool
    {
        $errors = $this->checkErrors($this->values);
        foreach ($errors as $key => $val) {
            if (is_null($val)) {
                unset($errors[$key]);
            }
        }

        return !empty($errors) ? $errors : false;
    }
}
