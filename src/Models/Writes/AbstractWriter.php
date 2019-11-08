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

    abstract public function writeFile(array $columns, array $fields);

    /**
     * @param string $field
     * @return int
     */
    protected function intColumn(string $field): int
    {
        return intval($field);
    }

    /**
     * @param string $field
     * @return float
     */
    protected function floatColumn(string $field): float
    {
        return (float)$field;
    }

    /**
     * @param string $field
     * @return string
     */
    protected function stringColumn(string $field = ''): string
    {
        return '\'' . addslashes ($field) . '\'';
    }

    /**
     * @param array $values
     * @return int
     */
    protected function randColumn(array $values): int
    {
        return rand($values[0], $values[1]);
    }

    /**
     * @param array $values
     * @return string
     */
    protected function dateColumn(array $values): string
    {
        $dateStart = new DateTime($values[0]);
        $dateEnd = new DateTime($values[1]);

        $date = new DateTime();
        $date->setTimestamp(rand($dateStart->getTimestamp(), $dateEnd->getTimestamp()));

        return '\'' . $date->format('Y-m-d H:i:s'). '\'';
    }

    /**
     * @param array $columns
     * @param array $row
     * @return array
     * @throws WriterException
     */
    protected function validateColumns(array $columns, array $row): array
    {
        $results = null;
        if(count($row) !== count($columns)){
            throw new WriterException('Количество столбцов и строк не совпадает');
        }

        foreach ($columns as $key => $column) {
            $column = $this->removeBom($column);
            $method = 'string';
            $parameter = $row[$key];

            if (array_key_exists($column, $this->typeColumns)) {

                if (is_array($this->typeColumns[$column])) {
                    $method = key($this->typeColumns[$column]);
                    $parameter = $this->typeColumns[$column][$method];
                } else {
                    $method = $this->typeColumns[$column];
                }

            }

            $results[$key] = $this->{$method . 'Column'}($parameter);
        }

        return $results;

    }

    protected function removeBom($str = ""): string
    {
        if (substr($str, 0, 3) == pack('CCC', 0xef, 0xbb, 0xbf)) {
            $str = substr($str, 3);
        }
        return $str;
    }
}