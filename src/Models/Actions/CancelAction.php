<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25.10.2019
 * Time: 19:50
 */

namespace HtmlAcademy\Models\Actions;


class CancelAction extends AbstractActions
{
    public function getName()
    {
        return __CLASS__;
    }

    public function getCodeName()
    {
        return 'cancel';
    }

    public function checkRightsUser($user_role)
    {
        return $user_role == 'customer' ? true : false;
    }
}