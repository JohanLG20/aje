<?php
namespace AJE\Utils;
use AJE\Model\DBFilteredBy;
use AJE\Model\DBFilterValues;

class TableCorrelation{
    private const CORRELATIONS = [
        "table6" => DBFilteredBy::class,
        "table8" => DBFilterValues::class

    ];

    public static function getCorrelation(string $table) : ?string{
        return self::CORRELATIONS[$table];
    }
}
