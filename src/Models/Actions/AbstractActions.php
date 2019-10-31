<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 24.10.2019
 * Time: 10:38
 */

namespace HtmlAcademy\Models\Actions;


use HtmlAcademy\Models\TaskForce;

/**
 * Class AbstractActions
 * @package HtmlAcademy\Models\Actions
 */
abstract class AbstractActions
{
    /**
     * Метод возвращает имя класса
     * @return string
     */
    abstract static public function getName():string;

    /**
     * Метод возвращает код действия
     * @return string
     */
    abstract static public function getCodeName():string;

    /**
     * Метод возвращает права пользователя в зависимости от статуса и роли пльзователя
     * @param $userId
     * @param TaskForce $taskForce
     * @return bool
     */
    abstract static public function checkRightsUser(int $userId, TaskForce $taskForce):bool;
}