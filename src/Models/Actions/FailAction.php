<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25.10.2019
 * Time: 19:49
 */

namespace HtmlAcademy\Models\Actions;


use HtmlAcademy\Models\TaskForce;

/**
 * Class FailAction
 * @package HtmlAcademy\Models\Actions
 */
class FailAction extends AbstractActions
{

    /**
     * @return string
     */
    public static function getCodeName(): string
    {
        return 'fail';
    }

    /**
     * @param int $userId
     * @param TaskForce $taskForce
     * @return bool
     */
    public static function checkRightsUser(int $userId, TaskForce $taskForce): bool
    {
        return $taskForce->getStatus() === TaskForce::STATUS_EXECUTION && $userId === $taskForce->getExecutorId();
    }
}