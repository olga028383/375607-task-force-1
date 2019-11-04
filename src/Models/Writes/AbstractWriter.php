<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 01.11.2019
 * Time: 22:32
 */
namespace HtmlAcademy\Models\Writes;

use HtmlAcademy\Models\Converters\Converter;

/**
 * Class AbstractWriter
 * @package HtmlAcademy\Models\Writes
 */
abstract class AbstractWriter
{
    protected $file;
    protected $extension;
    protected $filePath;

    /**
     * AbstractWriter constructor.
     * @param Converter $converter
     */
    public function __construct(Converter $converter){
        $this->file = $converter;
    }

    abstract public function getExtension();
    abstract public function setFilePath();
    abstract public function getFilePath();
    abstract public function write();

}