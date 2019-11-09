<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 01.11.2019
 * Time: 20:15
 */

namespace HtmlAcademy\Models\Converters;

use HtmlAcademy\Models\Readers\AbstractReaders;
use HtmlAcademy\Models\Writes\AbstractWriter;

/**
 * Class Converter
 * @package HtmlAcademy\Models\Converters
 */
class Converter
{
    /**
     * @var AbstractReaders
     */
    private $reader;

    /**
     * @var AbstractWriter
     */
    private $writer;

    /**
     * Converter constructor.
     * @param AbstractReaders $reader
     * @param AbstractWriter $writer
     */
    public function __construct(AbstractReaders $reader, AbstractWriter $writer )
    {

        $this->reader = $reader;
        $this->writer = $writer;
    }

    public function import(): void
    {
        $this->writer->writeFile($this->reader->getHeaders(), $this->reader->getRows());
    }

}