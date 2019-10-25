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
    public static function getName()
    {
        return __CLASS__;
    }

    public static function getCodeName()
    {
        return 'start';
    }

    public static function checkRightsUser($user_role)
    {
        return $user_role == 'customer' ? true : false;
    }
}