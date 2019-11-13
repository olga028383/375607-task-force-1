<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10.11.2019
 * Time: 16:45
 */

namespace HtmlAcademy\Models\RandomData;

/**
 * Class RandomDataDate
 * @package HtmlAcademy\Models\RandData
 */
class RandomDataDate implements RandomDataInterface
{
    /**
     * @param array $data
     * @return string
     */
    public function get(array $data): string
    {

        $dateStart = new \DateTime($data[0]);
        $dateEnd = new \DateTime($data[1]);

        $date = new \DateTime();
        $date->setTimestamp(rand($dateStart->getTimestamp(), $dateEnd->getTimestamp()));

        return $date->format('Y-m-d H:i:s');
    }
}