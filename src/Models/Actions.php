<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 24.10.2019
 * Time: 10:38
 */

namespace HtmlAcademy\Models;


abstract class Actions
{
    public static function getName(){}
    public static function getCodeName(){}
    public static function checkRightsUser($user_role){}
}