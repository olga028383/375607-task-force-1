<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10.11.2019
 * Time: 16:43
 */

namespace HtmlAcademy\Models\RandomData;

/**
 * Class RandomDataNumber
 * @package HtmlAcademy\Models\RandomData
 */
class RandomDataNumber implements RandomDataInterface
{
    /**
     * @param array $data
     * @return int
     */
    public function get(array $data): int
    {
        return rand($data[0], $data[1]);
    }
}