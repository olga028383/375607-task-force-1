<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 02.11.2019
 * Time: 0:14
 */

namespace HtmlAcademy\Models\Writes;


class SqlWriter extends AbstractWriter
{
    protected $extension = '.sql';

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
    public function setFilePath(): void
    {
        $this->filePath = $this->file->getDirName() . $this->file->getFileName() . $this->extension;
    }

    /**
     * @return string
     */
    public function getFilePath(): string
    {
        return $this->filePath;
    }

    /**
     *
     */
    public function write(): void
    {
        $this->setFilePath();
        $sqlFile = new \SplFileObject($this->filePath, "w");

        foreach ($this->file->getRows() as $row) {
            $sqlFile->fwrite('INSERT INTO ' . $this->file->getTableName() . '(' . implode(',', $this->file->getColumns()) . ') VALUES (\'' . implode('\',\'', $row) . '\');' . PHP_EOL);
        }
    }

}