<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25.10.2019
 * Time: 19:47
 */

namespace HtmlAcademy\Models\Actions;


use HtmlAcademy\Models\TaskForce;

/**
 * Class StartAction
 * @package HtmlAcademy\Models\Actions
 */
class StartAction extends AbstractActions
{
    /**
     * @return string
     */
    public static function getCodeName():string
    {
        return 'start';
    }

    /**
     * @param int $userId
     * @param TaskForce $taskForce
     * @return bool
     */
    public static function checkRightsUser(int $userId, TaskForce $taskForce):bool
    {
        return $taskForce->getStatus() === TaskForce::STATUS_NEW && $userId === $taskForce->getCustomerID();
    }
}