<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 01.11.2019
 * Time: 22:37
 */

namespace HtmlAcademy\Models\Readers;


use HtmlAcademy\Models\Ex\ReaderException;

/**
 * Class CsvReader
 * @package HtmlAcademy\Models\Readers
 */
class CsvReader extends AbstractReaders
{
    /**
     * @var string
     */
    protected $extensionCsv = 'csv';

    public function __construct($filePath)
    {
        parent::__construct($filePath);

        if ($this->extension !== $this->extensionCsv) {
            throw new ReaderException('Передан неверный формат файла');
        }

    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        $this->fileObject->rewind();
        return $this->fileObject->fgetcsv();
    }

    /**
     * @return array
     */
    public function getRows(): array
    {
        $result = null;

        foreach ($this->getLine() as $row) {

            if (implode($row)) {
                $result[] = $row;
            }
        }

        return $result;
    }

    /**
     * @return iterable|null
     */
    public function getLine():?iterable
    {
        $result = null;

        while (!$this->fileObject->eof()) {
            yield $this->fileObject->fgetcsv();
        }
        return $result;
    }
}