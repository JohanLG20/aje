<?php
namespace AJE\Model;

interface AssociativeTable{
    public static function getElementsForId(string $id, string $elementToGet) : array|bool;
}