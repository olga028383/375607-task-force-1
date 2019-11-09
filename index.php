<?php

use HtmlAcademy\Models\TaskForce;
use HtmlAcademy\Models\Converters\Converter;
use HtmlAcademy\Models\Actions;
use HtmlAcademy\Models\Readers\CsvReader;
use HtmlAcademy\Models\Writes\SqlWriter;


require_once 'vendor/autoload.php';

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


$data = array();
include 'dataConverter.php';

try {

    foreach($data as $key => $value){
        $reader = new CsvReader(__DIR__ . '/data/'.$value['name'].'.csv');
        $writer = new SqlWriter(__DIR__ . '/sql/sql_data/', $value['name'], $value['name'], $value['fields']);
        $converter = new Converter($reader, $writer);
        $converter->import();
    }

    $writerSpecializationCategory = new SqlWriter(__DIR__ . '/sql/sql_data/', 'user_specialization_category', false, array('user_id' => array('rand' => array(1,20)), 'categories_id' => array('rand' => array(1,8))));
    $writerSpecializationCategory->writeFile(array('user_id', 'categories_id'), array_fill(0, 20, array_fill(0, 2, ' ')));

    $writerFavouriteUsers = new SqlWriter(__DIR__ . '/sql/sql_data/', 'favourite_users', false, array('user_current' => array('rand' => array(1,20)), 'user_added' => array('rand' => array(1,20))));
    $writerFavouriteUsers->writeFile(array('user_current', 'user_added'), array_fill(0, 20, array_fill(0, 2, ' ')));

    $writerChats = new SqlWriter(__DIR__ . '/sql/sql_data/', 'chats', false,
        array('task_id' => array('rand' => array(1, 5)),
            'executor_id' => array('rand' => array(1, 20)),
            'is_closed' => array('rand' => array(0, 1))
        ));
    $writerChats->writeFile(array('task_id', 'executor_id', 'is_closed'), array_fill(0, 20, array_fill(0, 3, ' ')));

} catch (\HtmlAcademy\Models\Ex\ReaderException $value) {
    echo $value->getMessage();
} catch (\HtmlAcademy\Models\Ex\WriterException $value) {
    echo $value->getMessage();
} catch (\HtmlAcademy\Models\Ex\ConverterException $value) {
    echo $value->getMessage();
}

