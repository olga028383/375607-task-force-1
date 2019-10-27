<?php

use HtmlAcademy\Models\TaskForce;
use HtmlAcademy\Models\Actions;
require_once 'vendor/autoload.php';

assert_options(ASSERT_CALLBACK, 'assert_handler');

/**
 * Функция печатает сообщение об ошибке
 * @param $file
 * @param $line
 * @param $code
 */
function assert_handler($file, $line, $code)
{
    echo "<hr>Неудачная проверка утверждения:
        Файл '$file'<br />
        Строка '$line'<br />
        Код '$code'<br /><hr />";
}

$object = TaskForce::createTask(1,2,3,4, false, 6,7,8,9, 10);

assert(TaskForce::STATUS_NEW === $object->getNextStatus(Actions\AddAction::class), 'assert_handler');
assert(TaskForce::STATUS_NEW === $object->getNextStatus(Actions\RespondAction::class), 'assert_handler');
assert(TaskForce::STATUS_EXECUTION === $object->getNextStatus(Actions\StartAction::class), 'assert_handler');
assert(TaskForce::STATUS_CANCELED === $object->getNextStatus(Actions\CancelAction::class), 'assert_handler');
assert(TaskForce::STATUS_FAILED === $object->getNextStatus(Actions\FailAction::class), 'assert_handler');
assert(TaskForce::STATUS_COMPLETED === $object->getNextStatus(Actions\CompleteAction::class), 'assert_handler');


assert(array(Actions\CancelAction::class) === $object->getAvailableActions(TaskForce::ROLE_CUSTOMER), 'assert_handler');
assert(array(Actions\RespondAction::class) === $object->getAvailableActions(TaskForce::ROLE_EXECUTOR), 'assert_handler');

$object2 = TaskForce::createTask(1,2,3,4, false, 6,7,8,9, 'on execution');
assert(array(Actions\CompleteAction::class) === $object2->getAvailableActions(TaskForce::ROLE_CUSTOMER), 'assert_handler');
assert(array(Actions\FailAction::class) === $object2->getAvailableActions(TaskForce::ROLE_EXECUTOR), 'assert_handler');