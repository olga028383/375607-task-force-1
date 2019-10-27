<?php

use HtmlAcademy\Models\TaskForce;
use HtmlAcademy\Models\Actions;
require_once 'vendor/autoload.php';

$object = TaskForce::createTask(1,2,3,4, false, 6,7,8,9);
$object->setExecutorId(2);

assert(TaskForce::STATUS_NEW === $object->getNextStatus(Actions\AddAction::class));
assert(TaskForce::STATUS_NEW === $object->getNextStatus(Actions\RespondAction::class));
assert(TaskForce::STATUS_EXECUTION === $object->getNextStatus(Actions\StartAction::class));
assert(TaskForce::STATUS_CANCELED === $object->getNextStatus(Actions\CancelAction::class));
assert(TaskForce::STATUS_FAILED === $object->getNextStatus(Actions\FailAction::class));
assert(TaskForce::STATUS_COMPLETED === $object->getNextStatus(Actions\CompleteAction::class));


assert(array(Actions\StartAction::getCodeName(), Actions\CancelAction::getCodeName(), Actions\CommentAction::getCodeName()) === $object->getAvailableActions(1));
assert(array(Actions\RespondAction::getCodeName(), Actions\CommentAction::getCodeName()) === $object->getAvailableActions(2));

$object->setStatus(TaskForce::STATUS_EXECUTION);
assert(array(Actions\CompleteAction::getCodeName()) === $object->getAvailableActions(1));
assert(array(Actions\FailAction::getCodeName()) === $object->getAvailableActions(2));

$object->setStatus(TaskForce::STATUS_COMPLETED);
assert(array() === $object->getAvailableActions(1));
assert(array() === $object->getAvailableActions(2));

$object->setStatus(TaskForce::STATUS_CANCELED);
assert(array() === $object->getAvailableActions(1));
assert(array() === $object->getAvailableActions(2));

$object->setStatus(TaskForce::STATUS_FAILED);
assert(array() === $object->getAvailableActions(1));
assert(array() === $object->getAvailableActions(2));