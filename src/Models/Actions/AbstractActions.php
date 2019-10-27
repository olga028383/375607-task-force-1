<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 24.10.2019
 * Time: 10:38
 */

namespace HtmlAcademy\Models\Actions;

use HtmlAcademy\Models\TaskForce;

abstract class AbstractActions
{
    /**
     * Метод возвращает имя класса
     * @return mixed
     */
    abstract static public function getName();

    /**
     * Метод возвращает код действия
     * @return mixed
     */
    abstract static public function getCodeName();

    /**
     * Метод возвращает права пользователя в зависимости от статуса и роли пльзователя
     * @param $userID
     * @param TaskForce $taskForce
     * @return mixed
     */
    abstract static public function checkRightsUser($userID, TaskForce $taskForce);
}