<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 01.11.2019
 * Time: 22:32
 */

namespace HtmlAcademy\Models\Readers;


use HtmlAcademy\Models\Converters\Converter;
use HtmlAcademy\Models\Ex\ReaderException;

/**
 * Class AbstractReaders
 * @package HtmlAcademy\Models\Readers
 */
abstract class AbstractFileReader
{
    /**
     * @var string
     */
    protected $pathFile;

    /**
     * @var \SplFileObject
     */
    protected $fileObject;

    /**
     * @var string
     */
    protected $fileName;

    /**
     * @var string
     */
    protected $extension;


    /**
     * AbstractReaders constructor.
     * @param $filePath
     * @throws ReaderException
     */
    public function __construct($filePath)
    {

        if (!file_exists($filePath)) {
            throw new ReaderException('Файл "' . $filePath . '" не существует');
        }

        $this->pathFile = $filePath;
        $fileInfo = new \SplFileObject($this->pathFile);

        if (!$fileInfo->isReadable()) {
            throw new ReaderException('Файл недоступен для чтения');
        }

        $this->fileObject = $fileInfo->openFile();
        $this->extension = $fileInfo->getExtension();
        $this->fileName = $fileInfo->getBasename('.' . $this->extension);
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * @param string $str
     * @return string
     */
    protected function removeBom($str = ""): string
    {
        if (substr($str, 0, 3) == pack('CCC', 0xef, 0xbb, 0xbf)) {
            $str = substr($str, 3);
        }
        return $str;
    }

    /**
     * @return mixed
     */
    abstract public function getHeaders();

    /**
     * @return mixed
     */
    abstract public function getLine();
}