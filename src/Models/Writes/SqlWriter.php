<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 02.11.2019
 * Time: 0:14
 */

namespace HtmlAcademy\Models\Writes;

/**
 * Class SqlWriter
 * @package HtmlAcademy\Models\Writes
 */
class SqlWriter extends AbstractWriter
{
    /**
     * @var string
     */
    protected $extension = '.sql';

    /**
     * @var string
     */
    private $filePath;

    /**
     * @return string
     */
    public function getExtension(): string
    {
        return $this->extension;
    }

    /**
     * Метод создает файл
     */
    public function setFilePath(): void
    {
        $this->filePath = $this->dirName . $this->fileName . $this->extension;
    }

    /**
     * @return string
     */
    public function getFilePath(): string
    {
        return $this->filePath;
    }

    /**
     * @param array $columns
     * @param array $rows
     */
    public function writeFile(array $columns, array $rows): void
    {
        $this->setFilePath();
        $sqlFile = new \SplFileObject($this->filePath, "w");

        foreach ($rows as $row) {
            $sqlFile->fwrite('INSERT INTO' . ' ' . $this->tableName . '(`' . implode('`,`', $columns) . '`) VALUES (' . implode(',', $this->validateColumns($columns, $row)) . ');' . PHP_EOL);

        }
    }

}