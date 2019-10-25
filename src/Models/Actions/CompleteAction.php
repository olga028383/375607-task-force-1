<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25.10.2019
 * Time: 19:48
 */

namespace HtmlAcademy\Models\Actions;


class CompleteAction extends AbstractActions
{
    public function getName()
    {
        return __CLASS__;
    }

    public function getCodeName()
    {
        return 'complete';
    }

    public function checkRightsUser($user_role)
    {
        return $user_role == 'executor' ? true : false;
    }
}