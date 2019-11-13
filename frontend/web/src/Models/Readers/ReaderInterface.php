<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10.11.2019
 * Time: 17:05
 */

namespace HtmlAcademy\Models\Readers;

/**
 * Interface ReaderInterface
 * @package HtmlAcademy\Models\Readers
 */
interface ReaderInterface
{
    /**
     * @return array
     */
    public function getHeaders();

    /**
     * @return array
     */
    public function getLine();
}