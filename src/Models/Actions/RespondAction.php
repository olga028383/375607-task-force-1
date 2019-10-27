<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25.10.2019
 * Time: 19:46
 */

namespace HtmlAcademy\Models\Actions;


use HtmlAcademy\Models\TaskForce;

class RespondAction extends AbstractActions
{
    public static function getName()
    {
        return __CLASS__;
    }

    public static function getCodeName()
    {
        return 'respond';
    }

    public static function checkRightsUser($userID, TaskForce $taskForce)
    {
        return $taskForce->getStatus() === TaskForce::STATUS_NEW && $userID === $taskForce->getExecutorId();
    }
}