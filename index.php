<?php

include 'TaskForce.php';

$object = TaskForce::createTask(1,2,3,4, false, 6,7,8,9, 10);
$object->addResponse(2,3,4,5);
$object->beginTask(2);
var_dump($object);