<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25.10.2019
 * Time: 19:46
 */

namespace HtmlAcademy\Models\Actions;


use HtmlAcademy\Models\TaskForce;

/**
 * Class RespondAction
 * @package HtmlAcademy\Models\Actions
 */
class RespondAction extends AbstractActions
{


    /**
     * @return string
     */
    public static function getCodeName():string
    {
        return 'respond';
    }

    /**
     * @param int $userId
     * @param TaskForce $taskForce
     * @return bool
     */
    public static function checkRightsUser(int $userId, TaskForce $taskForce):bool
    {
        return $taskForce->getStatus() === TaskForce::STATUS_NEW && $userId === $taskForce->getExecutorId();
    }
}