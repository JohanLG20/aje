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
                    $escapedValues[$key] = trim(htmlspecialchars($val));
                }
            }

            return $escapedValues;
        } else {
            return [];
        }
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

    /*
    Function that make the cartesian product of a 2 dimensionnal array
    Thanks Claude.ai
    */
    public static function cartesianProduct(array $tableaux): array
    {
        $resultat = [[]];

        foreach ($tableaux as $indice => $valeurs) {
            $nouvelleListe = [];
            foreach ($resultat as $combinaisonExistante) {
                foreach ($valeurs as $valeur) {
                    $nouvelleListe[] = $combinaisonExistante + [$indice => $valeur];
                }
            }
            $resultat = $nouvelleListe;
        }

        return $resultat;
    }
}
