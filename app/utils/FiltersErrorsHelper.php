<?php

namespace AJE\Utils;

class FiltersErrorsHelper extends ErrorHelper{

    public function __construct(array $valuesToGet)
    {
       parent::ErrorHelper($valuesToGet);
       
    }

    protected function checkErrors(): array
    {
        
    }
    
}