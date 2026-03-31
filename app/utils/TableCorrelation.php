<?php
namespace AJE\Utils;

use AJE\Model\DBChoices;
use AJE\Model\DBFilteredBy;
use AJE\Model\DBFilterValues;

class TableCorrelation{
    private const CORRELATIONS = [
        "table1" => DBChoices::class,
        "table6" => DBFilteredBy::class

    ];

    public static function getCorrelation(string $table) : ?string{
        return self::CORRELATIONS[$table];
    }
}
