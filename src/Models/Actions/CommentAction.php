<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25.10.2019
 * Time: 19:51
 */

namespace HtmlAcademy\Models\Actions;


class CommentAction extends AbstractActions
{
    public static function getName()
    {
        return __CLASS__;
    }

    public static function getCodeName()
    {
        return 'respond';
    }

    public static function checkRightsUser($user_role)
    {
        return $user_role == 'customer' ? true : false;
    }
}