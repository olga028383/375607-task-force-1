<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25.10.2019
 * Time: 19:50
 */

namespace HtmlAcademy\Models\Actions;


use HtmlAcademy\Models\TaskForce;

/**
 * Class CancelAction
 * @package HtmlAcademy\Models\Actions
 */
class CancelAction extends AbstractActions
{
    /**
     * @return string
     */
    public static function getName():string
    {
        return __CLASS__;
    }

    /**
     * @return string
     */
    public static function getCodeName():string
    {
        return 'cancel';
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