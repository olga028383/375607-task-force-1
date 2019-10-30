<?php

use HtmlAcademy\Models\TaskForce;
use HtmlAcademy\Models\Actions;
require_once 'vendor/autoload.php';

$object = TaskForce::createTask(1, 1, 1, 55.703019,37.530859,'Убрать квартиру', 'Убрать квартру в понедельник', 5000, '18.11.2019', '30.10.2019');

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

$object->cancelTask($object->getCustomerId());
assert(array() === $object->getAvailableActions(1));
assert(array() === $object->getAvailableActions(2));

$object->failTask();
assert(array() === $object->getAvailableActions(1));
assert(array() === $object->getAvailableActions(2));