<?php
namespace AJE\Utils;

use AJE\Model\DBChoice_;
use AJE\Model\DBFilteredBy;

class TableCorrelation{
    private const CORRELATIONS = [
        "table1" => DBChoice_::class,
        "table6" => DBFilteredBy::class

    ];

    public static function getCorrelation(string $table) : ?string{
        return self::CORRELATIONS[$table];
    }
}
