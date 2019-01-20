<?php

namespace Tests\Unit\Http\CustomFunctions;

use App\Http\CustomFunctions\CFArray;
use Tests\TestCase;

class CFArrayTest extends TestCase
{
    public function testGetValueFromSimpleArray()
    {
        $array = ['key' => 'value'];
        $value = CFArray::getArrayValue($array, 'key');

        $this->assertEquals('value', $value, 'Can not collect the value of the simple array');
    }

    public function testGetValueFromMultidimensionalArray()
    {
        $array = [
            'key' => [
                'key1' => 'value'
            ]
        ];

        $value = CFArray::getArrayValue($array, 'key->key1');

        $this->assertEquals('value', $value, 'Can not collect the value of the multidimensional array');
    }
}