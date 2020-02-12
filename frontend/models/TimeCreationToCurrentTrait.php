<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 09.12.2019
 * Time: 19:39
 */

namespace frontend\models;
use morphos\Russian;
/**
 * Trait TimeCreationToCurrentTrait
 * @package frontend\models
 */
trait TimeCreationToCurrentTrait
{
    /**
     * @return \DateInterval
     */
    private function getTimeCreationToCurrent(string $date): \DateInterval
    {
        $current = new \DateTime();
        return $current->diff(new \DateTime($date));
    }

    /**
     * @param string $date
     * @return string
     */
    public function getYear(string $date): string
    {
        return ($this->getTimeCreationToCurrent($date)->y)? Russian\pluralize($this->getTimeCreationToCurrent($date)->y, 'год') . ' ' : '';
    }

    /**
     * @param string $date
     * @return string
     */
    public function getMonth(string $date): string
    {
        return ($this->getTimeCreationToCurrent($date)->m)? Russian\pluralize($this->getTimeCreationToCurrent($date)->m, 'месяц') . ' '  : '';
    }

    /**
     * @param string $date
     * @return string
     */
    public function getDay(string $date): string
    {
        return ($this->getTimeCreationToCurrent($date)->d)? Russian\pluralize($this->getTimeCreationToCurrent($date)->d, 'день') . ' '  : '';
    }

    /**
     * @param string $date
     * @return string
     */
    public function getHour(string $date): string
    {
        return ($this->getTimeCreationToCurrent($date)->h)? Russian\pluralize($this->getTimeCreationToCurrent($date)->h, 'час') . ' '  : '';
    }

    /**
     * @param string $date
     * @return string
     */
    public function getMinutes(string $date): string
    {
        return ($this->getTimeCreationToCurrent($date)->i)? Russian\pluralize($this->getTimeCreationToCurrent($date)->i, 'минута') . ' '  : '';
    }

    /**
     * @param string $date
     * @return string
     */
    public function getSecond(string $date): string
    {
        return ($this->getTimeCreationToCurrent($date)->s)? Russian\pluralize($this->getTimeCreationToCurrent($date)->s, 'секунда') . ' '  : '';
    }

    /**
     * @param string $date
     * @return string
     */
    public function getFullDate(string $date): string
    {

        return $this->getYear($date)
            .$this->getMonth($date)
            .$this->getDay($date)
            .$this->getHour($date)
            .$this->getMinutes($date)
            .$this->getSecond($date);

    }
}