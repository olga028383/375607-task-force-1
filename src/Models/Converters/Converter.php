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
        $this->fileName = $fileInfo->getBasename('.'.$this->extension);

        if(!$tableName){
            $this->tableName = $this->fileName;
        }

        $this->dirName = $dirName;
    }

    public function import(){

        $objectReader = 'HtmlAcademy\Models\Readers\\'.ucfirst($this->extension).'Reader';

        if(!class_exists($objectReader)){
            throw new ConverterException('Класс '.$objectReader.' для чтения файла не сушествует');
        }

        $reader = new $objectReader($this);

        if (count(array_uintersect($reader->getHeaders(), $this->columns, "trim")) !== count($this->columns)) {
            throw new ConverterException('Количество колонок не соответствует переданным');
        }
        $this->rows = $reader->getRows();

        $objectWriter = 'HtmlAcademy\Models\Writes\SqlWriter';

        if(!class_exists($objectWriter)){
            throw new ConverterException('Класс '.$objectWriter.' для чтения файла не сушествует');
        }

        $writer = new $objectWriter($this);
        $writer->write();

    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->rows;
    }

    public function getFileObject()
    {
        return $this->fileObject;
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    public function getDirName()
    {
        return $this->dirName;
    }
    public function getColumns()
    {
        return $this->columns;
    }
    public function getRows()
    {
        return $this->rows;
    }
    public function getTableName()
    {
        return $this->tableName;
    }
}