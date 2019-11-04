<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 01.11.2019
 * Time: 22:32
 */

namespace HtmlAcademy\Models\Readers;


use HtmlAcademy\Models\Converters\Converter;

/**
 * Class AbstractReaders
 * @package HtmlAcademy\Models\Readers
 */
abstract class AbstractReaders
{
    protected $file;

    /**
     * AbstractReaders constructor.
     * @param Converter $converter
     */
    public function __construct(Converter $converter){
        $this->file = $converter;
    }

    /**
     * @return mixed
     */
    abstract public function getHeaders();

    /**
     * @return mixed
     */
    abstract public function getRows();

    /**
     * @return mixed
     */
    abstract public function getLine();

}