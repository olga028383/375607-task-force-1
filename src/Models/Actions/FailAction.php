<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25.10.2019
 * Time: 19:49
 */

namespace HtmlAcademy\Models\Actions;


class FailAction extends AbstractActions
{
    public static function getName()
    {
        return __CLASS__;
    }

    public static function getCodeName()
    {
        return 'fail';
    }

    public static function checkRightsUser($user_role)
    {
        return $user_role == 'executor' ? true : false;
    }
}