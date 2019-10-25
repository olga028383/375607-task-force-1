<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25.10.2019
 * Time: 19:47
 */

namespace HtmlAcademy\Models\Actions;


class StartAction extends AbstractActions
{
    public function getName()
    {
        return __CLASS__;
    }

    public function getCodeName()
    {
        return 'start';
    }

    public function checkRightsUser($user_role)
    {
        return $user_role == 'customer' ? true : false;
    }
}