<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 24.10.2019
 * Time: 10:45
 */

namespace HtmlAcademy\Models;


class AddAction extends Actions
{
    public static function getName(){
        return 'Добавить';
    }
    public static function getCodeName(){
        return 'add';
    }
    public static function checkRightsUser($user_role){
        return $user_role == 'customer' ? true : false;
    }
}