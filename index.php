<?php
assert_options(ASSERT_CALLBACK, 'assert_handler');
function assert_handler($file, $line, $code)
{
    echo "<hr>Неудачная проверка утверждения:
        Файл '$file'<br />
        Строка '$line'<br />
        Код '$code'<br /><hr />";
}

include 'TaskForce.php';

$object = TaskForce::createTask(1,2,3,4, false, 6,7,8,9, 10);


assert(TaskForce::STATUS_NEW === $object->getNextStatus(TaskForce::ACTION_ADD), 'assert_handler');
assert(TaskForce::STATUS_NEW === $object->getNextStatus(TaskForce::ACTION_RESPOND), 'assert_handler');
assert(TaskForce::STATUS_START === $object->getNextStatus(TaskForce::ACTION_BEGIN), 'assert_handler');
assert(TaskForce::STATUS_CLOSED === $object->getNextStatus(TaskForce::ACTION_CLOSE), 'assert_handler');
assert(TaskForce::STATUS_FAILED === $object->getNextStatus(TaskForce::ACTION_FAIL), 'assert_handler');
assert(TaskForce::STATUS_CANCELED === $object->getNextStatus(TaskForce::ACTION_CANCEL), 'assert_handler');

//В данном случае проверка выполнена, так как $this->action = 'new';
// А как сделать остальные проверки для этого метода? Ведь как только статус изменится эта проверка даст ошибку?
assert(array(TaskForce::ACTION_CANCEL, TaskForce::ACTION_CLOSE) === $object->getAvailableActions(TaskForce::RIGHTS_CUSTOMER), 'assert_handler');

