<?php

use HtmlAcademy\Models\TaskForce;

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
var_dump(TaskForce::ACTION_ADD);
assert(TaskForce::STATUS_NEW === $object->getNextStatus(TaskForce::ACTION_ADD), 'assert_handler');
assert(TaskForce::STATUS_NEW === $object->getNextStatus(TaskForce::ACTION_RESPOND), 'assert_handler');
assert(TaskForce::STATUS_EXECUTION === $object->getNextStatus(TaskForce::ACTION_START), 'assert_handler');
assert(TaskForce::STATUS_CANCELED === $object->getNextStatus(TaskForce::ACTION_CANCEL), 'assert_handler');
assert(TaskForce::STATUS_FAILED === $object->getNextStatus(TaskForce::ACTION_FAIL), 'assert_handler');
assert(TaskForce::STATUS_CANCELED === $object->getNextStatus(TaskForce::ACTION_CANCEL), 'assert_handler');


assert(array(TaskForce::ACTION_CANCEL, TaskForce::ACTION_START) === $object->getAvailableActions(TaskForce::ROLE_CUSTOMER), 'assert_handler');
assert(array(TaskForce::ACTION_RESPOND, TaskForce::ACTION_COMMENT) === $object->getAvailableActions(TaskForce::ROLE_EXECUTOR), 'assert_handler');
