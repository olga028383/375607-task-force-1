<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 01.11.2019
 * Time: 22:32
 */

namespace HtmlAcademy\Models\Readers;


use HtmlAcademy\Models\Converters\Converter;

abstract class AbstractReaders
{
    protected $file;

    public function __construct(Converter $converter){
        $this->file = $converter;
    }
    abstract public function getHeaders();
    abstract public function getRows();
    abstract public function getLine();

}