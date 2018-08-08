<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 07.08.2018
 * Time: 11:40
 */

namespace Model\DataAccess\Util;

class StringUtil
{
    /**
     * Converts a string from snake case to camel case.
     * @param string $snakeCase The string in snake case.
     * @return string The string in camel case.
     */
    public static function snakeCaseToCamelcase(string $snakeCase): string
    {
        $terms = explode('_', $snakeCase);
        if (count($terms) === 1) {
            return $snakeCase;
        }
        $withoutFirstTerm = array_slice($terms, 1);
        $camelCase[]      = $terms[0];
        foreach ($withoutFirstTerm as $term) {
            $camelCase[] = ucwords($term);
        }
        return implode('', $camelCase);
    }

    /**
     * Converts a string of form 'column_id' into 'column'.
     * @param string $idExtendedString The string with the id extension.
     * @return string The string without the id extension.
     */
    public static function removeIdExtension(string $idExtendedString): string
    {
        //Ofsset where the '_id' extension begins
        $offset              = strlen($idExtendedString) - 3;
        $lastThreeCharacters = substr($idExtendedString, $offset, 3);
        //If the last 3 characters are not as expected, return the same string
        if (strcmp($lastThreeCharacters, '_id') !== 0) {
            return $idExtendedString;
        }
        return substr($idExtendedString, 0, $offset);
    }
}