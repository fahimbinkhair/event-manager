<?php
/**
 * deals with object
 *
 * @author Md Fahim Uddin <visionq9@gmail.com>
 */
declare(strict_types=1);

namespace App\Http\CustomFunctions;


class CFObject
{
    /**
     * convert an array into associative array
     * @note: only works for public members ob your object
     *
     * @param object $object
     *
     * @return array
     */
    public static function objectToArray($object): array
    {
        $array = json_decode(json_encode($object), true);

        return $array;
    }
}