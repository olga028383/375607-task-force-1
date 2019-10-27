<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25.10.2019
 * Time: 19:47
 */

namespace HtmlAcademy\Models\Actions;


use HtmlAcademy\Models\TaskForce;

class StartAction extends AbstractActions
{
    public static function getName()
    {
        return __CLASS__;
    }

    public static function getCodeName()
    {
        return 'start';
    }

    public static function checkRightsUser($userId, TaskForce $taskForce)
    {
        return $taskForce->getStatus() === TaskForce::STATUS_NEW && $userId === $taskForce->getCustomerID();
    }
}