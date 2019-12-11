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
    private function getTimeCreationToCurrent(): \DateInterval
    {
        $current = new \DateTime();
        return $current->diff(new \DateTime($this->created));
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->getTimeCreationToCurrent()->y;
    }

    /**
     * @return int
     */
    public function getMonth(): int
    {
        return $this->getTimeCreationToCurrent()->m;
    }

    /**
     * @return int
     */
    public function getDay(): int
    {
        return $this->getTimeCreationToCurrent()->d;
    }

    /**
     * @return int
     */
    public function getHour(): int
    {
        return $this->getTimeCreationToCurrent()->h;
    }
}