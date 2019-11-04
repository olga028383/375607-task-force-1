<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 01.11.2019
 * Time: 22:37
 */

namespace HtmlAcademy\Models\Readers;


class CsvReader extends AbstractReaders
{
    /**
     * @return array
     */
    public function getHeaders(): array
    {
        $this->file->getFileObject()->rewind();
        return $this->file->getFileObject()->fgetcsv();
    }

    /**
     * @return array
     */
    public function getRows(): array
    {
        $result = null;

        foreach ($this->getLine() as $row) {
            if (count($row) === count($this->file->getColumns())) {
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
        while (!$this->file->getFileObject()->eof()) {
            yield $this->file->getFileObject()->fgetcsv();
        }
        return $result;
    }
}