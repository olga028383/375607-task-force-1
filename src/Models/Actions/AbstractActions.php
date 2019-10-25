<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 24.10.2019
 * Time: 10:38
 */

namespace HtmlAcademy\Models\Actions;


abstract class AbstractActions
{
    abstract static public function getName();

    abstract static public function getCodeName();

    abstract static public function checkRightsUser($user_role);
}