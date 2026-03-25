<?php

namespace AJE\Services;

abstract class DataChecker
{
    /**
     * @return array Returns the escaped values of an array, if there are no values in post, returns an empty array
     */
    public static function escapeValues(array $arr): array | bool
    {

        if (!empty($arr)) {
            $escapedValues = [];

            foreach ($arr as $key => $val) {
                if (is_array($val)) {
                    $escapedValues[$key] = self::escapeValues($val);
                } else {
                    $escapedValues[$key] = trim(htmlspecialchars($val));
                }
            }

            return $escapedValues;
        } else {
            return false;
        }
    }

}
