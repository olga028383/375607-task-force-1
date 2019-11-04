<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 01.11.2019
 * Time: 20:15
 */

namespace HtmlAcademy\Models\Converters;


use HtmlAcademy\Models\Ex\ConverterException;
use HtmlAcademy\Models\Readers;

/**
 * Class Converter
 * @package HtmlAcademy\Models\Converters
 */
class Converter
{
    private $pathFile;
    private $fileObject;
    private $fileName;
    private $tableName;
    private $columns;
    private $extension;
    private $rows;
    private $dirName;


    /**
     * Converter constructor.
     * @param string $filePath
     * @param array $columns
     * @throws ConverterException
     */
    public function __construct(string $filePath, array $columns, string $dirName, string $tableName = '')
    {
        if (empty($dirName)) {
            throw new ConverterException('Укажите директорию для сохранения файла');
        }

        if (!file_exists($filePath)) {
            throw new ConverterException('Файл "' . $filePath . '" не существует');
        }

        if (empty($columns)) {
            throw new ConverterException('Не переданы столбцы');
        }

        $fileInfo = new \SplFileObject($filePath);

        if (!$fileInfo->isReadable()) {
            throw new ConverterException('Файл недоступен для чтения');
        }

        $this->fileObject = $fileInfo->openFile();
        $this->pathFile = $filePath;
        $this->columns = $columns;
        $this->extension = $fileInfo->getExtension();
        $this->fileName = $fileInfo->getBasename('.' . $this->extension);

        if (!$tableName) {
            $this->tableName = $this->fileName;
        }

        $this->dirName = $dirName;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->rows;
    }

    /**
     * @return object
     */
    public function getFileObject(): object
    {
        return $this->fileObject;
    }

    /**
     * @return string
     */
    public function getExtension(): string
    {
        return $this->extension;
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * @return string
     */
    public function getDirName(): string
    {
        return $this->dirName;
    }

    /**
     * @return array
     */
    public function getColumns(): array
    {
        return $this->columns;
    }

    /**
     * @return array
     */
    public function getRows(): array
    {
        return $this->rows;
    }

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return $this->tableName;
    }

    public function import(): void
    {

        $objectReader = 'HtmlAcademy\Models\Readers\\' . ucfirst($this->extension) . 'Reader';

        if (!class_exists($objectReader)) {
            throw new ConverterException('Класс ' . $objectReader . ' для чтения файла не сушествует');
        }

        $reader = new $objectReader($this);

        if (count(array_uintersect($reader->getHeaders(), $this->columns, "trim")) !== count($this->columns)) {
            throw new ConverterException('Количество колонок не соответствует переданным');
        }
        $this->rows = $reader->getRows();

        $objectWriter = 'HtmlAcademy\Models\Writes\SqlWriter';

        if (!class_exists($objectWriter)) {
            throw new ConverterException('Класс ' . $objectWriter . ' для чтения файла не сушествует');
        }

        $writer = new $objectWriter($this);
        $writer->write();

    }


}