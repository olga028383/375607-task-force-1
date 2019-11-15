<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 01.11.2019
 * Time: 22:32
 */

namespace HtmlAcademy\Models\Writes;

use DateTime;
use HtmlAcademy\Models\Converters\Converter;
use HtmlAcademy\Models\Ex\WriterException;

/**
 * Class AbstractWriter
 * @package HtmlAcademy\Models\Writes
 */
abstract class AbstractWriter
{
    /**
     * @var string
     */
    protected $dirName;

    /**
     * @var string
     */
    protected $fileName;

    /**
     * @var string
     */
    protected $tableName;

    /**
     * @var array
     */
    protected $typeColumns;

    /**
     * AbstractWriter constructor.
     * @param Converter $converter
     */
    public function __construct(string $dirName, string $fileName, string $tableName, array $typeColumns = array())
    {

        if (!is_dir($dirName)) {
            throw new WriterException('Директория не существует');
        }

        if (!$fileName) {
            throw new WriterException('Необходимо передать имя файла');
        }

        if (!$tableName) {
            $this->tableName = $fileName;
        } else {
            $this->tableName = $tableName;
        }

        $this->dirName = $dirName;
        $this->fileName = $fileName;

        $this->typeColumns = $typeColumns;
    }

    abstract public function getExtension();

    abstract public function setFilePath();

    abstract public function getFilePath();

    abstract public function write(array $columns, array $fields);

}