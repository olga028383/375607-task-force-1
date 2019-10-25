<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 24.10.2019
 * Time: 10:45
 */


namespace HtmlAcademy\Models\Actions;


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

    public static function checkRightsUser($user_role)
    {
        return $user_role == 'customer' ? true : false;
    }
}