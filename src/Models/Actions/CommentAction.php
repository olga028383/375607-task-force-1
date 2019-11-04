<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25.10.2019
 * Time: 19:51
 */

namespace HtmlAcademy\Models\Actions;

use HtmlAcademy\Models\TaskForce;

/**
 * Class CommentAction
 * @package HtmlAcademy\Models\Actions
 */
class CommentAction extends AbstractActions
{


    /**
     * @return string
     */
    public static function getCodeName(): string
    {
        return 'comment';
    }

    /**
     * @param int $userId
     * @param TaskForce $taskForce
     * @return bool
     */
    public static function checkRightsUser(int $userId, TaskForce $taskForce): bool
    {
        return $taskForce->getStatus() === TaskForce::STATUS_NEW && ($userId === $taskForce->getCustomerID() || $userId === $taskForce->getExecutorId());
    }
}