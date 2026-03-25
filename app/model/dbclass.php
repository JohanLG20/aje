<?php

interface DBClass
{
    public static function getAllElements() : array;
    public static function addNewElement(array $params) : bool;
    public static function modifyElementById(array $params) : bool;
    public static function deleteElementById(array $params) : bool;
}
