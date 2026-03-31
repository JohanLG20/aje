<?php
namespace AJE\Model;

interface AssociativeTable{
    public function getElementsForId(string $id, string $elementToGet) : array|bool;
}