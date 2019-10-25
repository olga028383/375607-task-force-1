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
    public function getName()
    {
        return __CLASS__;
    }

    public function getCodeName()
    {
        return 'add';
    }

    public function checkRightsUser($user_role)
    {
        return $user_role == 'customer' ? true : false;
    }
}