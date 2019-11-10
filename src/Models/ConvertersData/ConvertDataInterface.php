<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10.11.2019
 * Time: 14:54
 */

namespace HtmlAcademy\Models\ConvertersData;

/**
 * Interface ConvertDataInterface
 * @package HtmlAcademy\Models\Converters
 */
interface ConvertDataInterface
{
    /**
     * @param string $data
     * @return mixed
     */
    public function convert(string $data);
}