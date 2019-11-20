<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 24.10.2019
 * Time: 10:45
 */


namespace HtmlAcademy\Models\Actions;


use HtmlAcademy\Models\TaskForce;

/**
 * Class AddAction
 * @package HtmlAcademy\Models\Actions
 */
class AddAction extends AbstractActions
{

    /**
     * @return string
     */
    public static function getCodeName(): string
    {
        return 'add';
    }

    /**
     * @param int $userId
     * @param TaskForce $taskForce
     * @return bool
     */
    public static function checkRightsUser(int $userId, TaskForce $taskForce): bool
    {
        return false;
    }
}