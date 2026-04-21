<?php

namespace AJE\Utils;

abstract class DataTransformer
{
    /**
     * @return array Returns the escaped values of an array, if there are no values in post, returns an empty array
     */
    public static function escapeValues(array $arr): array
    {

        if (!empty($arr)) {
            $escapedValues = [];

            foreach ($arr as $key => $val) {
                if (is_array($val)) {
                    $escapedValues[$key] = self::escapeValues($val);
                } else {
                    $escapedValues[$key] = self::escapeValue($val);
                }
            }

            return $escapedValues;
        } else {
            return [];
        }
    }
        /**
     * @return array Returns the escaped values of an array, if there are no values in post, returns an empty array
     */
    public static function escapeValue(string $val): string
    {
        return trim(htmlspecialchars($val));
    }

    public static function toCamelCase(string $str): string
    {
        $camel = strtolower($str);

        //This function transformes "\s[a-z]" into "[A-Z]"
        $camel = preg_replace_callback(
            "|(\s[a-z])|",
            function ($matches) {
                return trim(strtoupper($matches[1]));
            },
            $camel
        );

        return $camel;
    }

    public static function removeWhitespaces(string $str): string
    {
        return preg_replace("/\s/", "", $str);
    }

    /**
     * @param string $str The string we want to modify
     * 
     * @return string A string with the first letter in upper case and the rest in lower case
     */
    public static function makeCleanName(string $str) : string{
        return ucfirst(strtolower($str));
    }
}
