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

    public function getHeaders(){
        $this->file->getFileObject()->rewind();
        return $this->file->getFileObject()->fgetcsv();
    }

    public function getRows(){
        $result = null;

        foreach ($this->getLine() as $row) {
            if(count($row) === count($this->file->getColumns())){
                $result[] = $row;
            }
        }
        return $result;
    }

    public function getLine(){
        $result = null;
        while (!$this->file->getFileObject()->eof()) {
            yield $this->file->getFileObject()->fgetcsv();
        }
        return $result;
    }
}