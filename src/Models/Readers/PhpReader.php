<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10.11.2019
 * Time: 20:30
 */

namespace HtmlAcademy\Models\Readers;

/**
 * Class PhpReader
 * @package HtmlAcademy\Models\Readers
 */
class PhpReader implements ReaderInterface
{
    /**
     * @var array
     */
    private $headers;

    /**
     * @var array
     */
    private $body;

    /**
     * PhpReader constructor.
     * @param array $headers
     * @param array $body
     */
    public function __construct(array $headers, array $body)
    {
        $this->headers = $headers;
        $this->body = $body;
    }

    /**
     * @return array
     */
    public function getHeaders():array
    {
       return $this->headers;
    }

    /**
     * @return iterable
     */
    public function getLine(): iterable
    {
        foreach($this->body as $row){
            yield $row;
        }
    }
}