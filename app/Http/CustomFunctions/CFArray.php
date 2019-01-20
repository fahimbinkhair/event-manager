<?php
/**
 * deals with array
 *
 * @author Md Fahim Uddin <visionq9@gmail.com>
 */
declare(strict_types=1);

namespace App\Http\CustomFunctions;


class CFArray
{
    /**
     * get value of a array element
     * @example getArrayValue($_POST, nameOfIndexWithingPOST, defaultValue)
     *
     * @param array $array data source
     * @param string $keyName e.g. keyName or keyName->childKeyName->etc
     * @param null $defaultValue if key is not set
     *
     * @return mixed
     */
    public static function getArrayValue(array $array, string $keyName, $defaultValue = null)
    {
        if (strpos($keyName, '->') !== false) {
            $keyNames = explode('->', $keyName);
            $finalKey = array_pop($keyNames);

            foreach ($keyNames as $keyName) {
                if (array_key_exists($keyName, $array) && is_array($array[$keyName])) {
                    $array = $array[$keyName];
                }
            }

            $keyName = $finalKey;
        }

        $value = '';

        if (is_array($array) && array_key_exists($keyName, $array)) {
            $value = $array[$keyName];
        }

        if ($value !== false && $value !== 0 && empty($value)) {
            $value = $defaultValue;
        }

        return $value;
    }
}