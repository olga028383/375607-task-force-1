<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 09.12.2019
 * Time: 19:39
 */

namespace frontend\models;

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
     * @return int
     */
    public function getYear(string $date): int
    {
        return $this->getTimeCreationToCurrent($date)->y;
    }

    /**
     * @param string $date
     * @return int
     */
    public function getMonth(string $date): int
    {
        return $this->getTimeCreationToCurrent($date)->m;
    }

    /**
     * @param string $date
     * @return int
     */
    public function getDay(string $date): int
    {
        return $this->getTimeCreationToCurrent($date)->d;
    }

    /**
     * @param string $date
     * @return int
     */
    public function getHour(string $date): int
    {
        return $this->getTimeCreationToCurrent($date)->h;
    }

    /**
     * @param string $date
     * @return int
     */
    public function getMinutes(string $date): int
    {
        return $this->getTimeCreationToCurrent($date)->i;
    }

    /**
     * @param string $date
     * @return int
     */
    public function getSecond(string $date): int
    {
        return $this->getTimeCreationToCurrent($date)->s;
    }
}