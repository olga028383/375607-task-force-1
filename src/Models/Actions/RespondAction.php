<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25.10.2019
 * Time: 19:46
 */

namespace HtmlAcademy\Models\Actions;


class RespondAction extends AbstractActions
{
    public function getName()
    {
        return __CLASS__;
    }

    public function getCodeName()
    {
        return 'respond';
    }

    public function checkRightsUser($user_role)
    {
        return $user_role == 'executor' ? true : false;
    }
}