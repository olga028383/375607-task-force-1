<?php

use HtmlAcademy\Models\TaskForce;
use HtmlAcademy\Models\Actions;

require  './vendor/autoload.php';

$object = TaskForce::createTask(1, 1, 'Убрать квартиру', 'Убрать квартру в понедельник', 5000, '18.11.2019', '30.10.2019');

assert(TaskForce::STATUS_NEW === $object->getNextStatus(Actions\AddAction::class));
assert(TaskForce::STATUS_NEW === $object->getNextStatus(Actions\RespondAction::class));
assert(TaskForce::STATUS_EXECUTION === $object->getNextStatus(Actions\StartAction::class));
assert(TaskForce::STATUS_CANCELED === $object->getNextStatus(Actions\CancelAction::class));
assert(TaskForce::STATUS_FAILED === $object->getNextStatus(Actions\FailAction::class));
assert(TaskForce::STATUS_COMPLETED === $object->getNextStatus(Actions\CompleteAction::class));

//типа потенциальный исполнитель для теста
$object->addResponse(2);
assert(array(Actions\StartAction::getCodeName(), Actions\CancelAction::getCodeName(), Actions\CommentAction::getCodeName()) === $object->getAvailableActions(1));
assert(array(Actions\RespondAction::getCodeName(), Actions\CommentAction::getCodeName()) === $object->getAvailableActions(2));

$object->beginTask(2);
assert(array(Actions\CompleteAction::getCodeName()) === $object->getAvailableActions(1));
assert(array(Actions\FailAction::getCodeName()) === $object->getAvailableActions(2));

$object->completeTask();
assert(array() === $object->getAvailableActions(1));
assert(array() === $object->getAvailableActions(2));

$object2 = TaskForce::createTask(1, 1, 'Убрать квартиру', 'Убрать квартру в понедельник', 5000, '18.11.2019', '30.10.2019');
$object2->cancelTask($object2->getCustomerId());
assert(array() === $object2->getAvailableActions(1));
assert(array() === $object2->getAvailableActions(2));

$object3 = TaskForce::createTask(1, 1, 'Убрать квартиру', 'Убрать квартру в понедельник', 5000, '18.11.2019', '30.10.2019');
$object3->addResponse(2);
$object3->beginTask(2);
$object3->failTask();
assert(array() === $object3->getAvailableActions(1));
assert(array() === $object3->getAvailableActions(2));
