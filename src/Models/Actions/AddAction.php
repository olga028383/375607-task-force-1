<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 24.10.2019
 * Time: 10:45
 */


namespace HtmlAcademy\Models\Actions;


use HtmlAcademy\Models\TaskForce;

class AddAction extends AbstractActions
{
    public static function getName()
    {
        return __CLASS__;
    }

    public static function getCodeName()
    {
        return 'add';
    }

    public static function checkRightsUser($userId, TaskForce $taskForce)
    {
        return false;
    }
}