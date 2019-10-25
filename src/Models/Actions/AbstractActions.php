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
    abstract public function getName();

    abstract public function getCodeName();

    abstract public function checkRightsUser($user_role);
}