<?php

namespace HtmlAcademy\Models;

use HtmlAcademy\Models\Actions;

class TaskForce
{
    const STATUS_NEW = 'new';
    const STATUS_EXECUTION = 'on execution';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELED = 'canceled';
    const STATUS_FAILED = 'failed';

    const ROLE_CUSTOMER = 'customer';
    const ROLE_EXECUTOR = 'executor';

    private $customerId;
    private $executorId;

    private $taskId;
    private $name;
    private $description;
    private $categoryId;
    private $files;
    private $cityId;
    private $coordinates = array();
    private $sum;
    private $dateClosed;
    private $status;

    private $errors = array();

    /**
     * TaskForce constructor.
     * @param $customerId
     * @param $name
     * @param $description
     * @param $categoryId
     * @param $files
     * @param $cityId
     * @param $coordinates
     * @param $sum
     * @param $dateClosed
     * @param $status
     * @param $taskId
     */
    private function __construct($customerId, $name, $description, $categoryId, $files, $cityId, $coordinates, $sum, $dateClosed, $status, $taskId)
    {
        $this->customerId = $customerId;
        $this->name = $name;
        $this->description = $description;
        $this->categoryId = $categoryId;
        $this->files = $files;
        $this->cityId = $cityId;
        $this->coordinates = $coordinates;
        $this->sum = $sum;
        $this->dateClosed = $dateClosed;
        $this->taskId = $taskId;

        if (!$status) {
            $this->status = self::STATUS_NEW;
        } else {
            $this->status = $status;
        }

    }

    /**
     * Функция добавляет исполнителя
     * @param $customerId
     */
    public function setExecutorId($executorId)
    {
        $this->executorId = $executorId;
    }

    /**
     * Функция устанавливает статус
     * @param $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @return mixed
     */
    public function getExecutorId()
    {
        return $this->executorId;
    }

    /**
     * @return mixed
     */
    public function getDateClosed()
    {
        return $this->dateClosed;
    }

    /**
     * Метод возвращает все действия
     * @return array
     */
    public function getActions()
    {
        return array(
            Actions\AddAction::class,
            Actions\RespondAction::class,
            Actions\StartAction::class,
            Actions\CompleteAction::class,
            Actions\FailAction::class,
            Actions\CancelAction::class,
            Actions\CommentAction::class
        );
    }

    /**
     * Метод возвращает все статусы
     * @return array
     */
    public function getStatuses()
    {
        return array(
            self::STATUS_NEW,
            self::STATUS_EXECUTION,
            self::STATUS_CANCELED,
            self::STATUS_COMPLETED,
            self::STATUS_FAILED
        );
    }

    /**
     * Метод добавляет задачу
     * @param $customerId
     * @param $name
     * @param $description
     * @param $categoryId
     * @param array $files
     * @param $cityId
     * @param $coordinates
     * @param $sum
     * @param $dateClosed
     * @param $status
     * @return TaskForce
     */
    public static function createTask($customerId, $name, $description, $categoryId, $files = array(), $cityId, $coordinates, $sum, $dateClosed)
    {
        //Добавляю значения в базу получаю задачу
        $taskId = 1;
        $object = new TaskForce($customerId, $name, $description, $categoryId, $files, $cityId, $coordinates, $sum, $dateClosed, $status = '', $taskId);
        return $object;
    }

    /**
     * @param $taskId
     * @return TaskForce
     */
    public static function getTask($taskId)
    {
        //Получаю задачу из базы и создаю объект
        $customerId = 1;
        $name = 'Убрать квартиру';
        $description = 'Убрать квартру в понедельник';
        $categoryId = "Уборка";
        $files = array();
        $cityId = 1;
        $coordinates = array(55.703019, 37.530859);
        $sum = 5000.00;
        $dateClosed = 18.10;
        $taskId = 1;
        $status = 'new';

        $object = new TaskForce($customerId, $name, $description, $categoryId, $files, $cityId, $coordinates, $sum, $dateClosed, $taskId, $executorId = '');
        return $object;
    }

    /**
     * Метод возвращает статус, в зависимости от действия
     * @param $action
     * @return string
     */
    public function getNextStatus($action)
    {

        switch ($action) {
            case Actions\AddAction::class:
                $status = self::STATUS_NEW;
                break;
            case Actions\CommentAction::class:
                $status = $this->status;
                break;
            case Actions\RespondAction::class:
                $status = $this->status;
                break;
            case Actions\StartAction::class:
                $status = self::STATUS_EXECUTION;
                break;
            case Actions\CompleteAction::class:
                $status = self::STATUS_COMPLETED;
                break;
            case Actions\CancelAction::class:
                $status = self::STATUS_CANCELED;
                break;
            case Actions\FailAction::class:
                $status = self::STATUS_FAILED;
                break;
            default:
                throw new \Exception('Неизвестное действие.');
        }

        return $status;
    }

    /**
     * Возвращает список действий в зависимости от статуса задачи и роли пользователя
     * @param $userRole
     * @return array
     */
    public function getAvailableActions($userId)
    {
        $actions = array();

        foreach ($this->getActions() as $action) {
            if ($action::checkRightsUser($userId, $this)) {
                $actions[] = $action::getCodeName();
            }
        }
        return $actions;
    }

    /**
     * @param $executorId
     * @param $evaluation
     * @param $comments
     * @param $sum
     */
    public function addResponse($executorId, $evaluation, $comments, $sum)
    {
        //Добавить отклик к задаче
        //Будет какая-то таблица откликов с id задачи
    }

    /**
     * Задача выполняется, присваивается исполнитель
     * @param $executorId
     */
    public function beginTask($executorId)
    {
        //Добавляет  базу к задаче исполнителя и присваиваем новый статус
        $this->executorId = $executorId;
        $this->status = self::STATUS_EXECUTION;
    }

    /**
     * Метод говорит о том, что задача выполнена
     */
    public function completeTask()
    {
        $this->status = self::STATUS_COMPLETED;
    }

    /**
     * Метод изменяет статус провеленной задачи
     */
    public function failTask()
    {
        //Изменяет в таблице данные пользователя, счетчик провалов
        //Отвязать исполнителя от задачи?
        $this->status = self::STATUS_FAILED;
    }

    /**
     * @return array
     */
    public function cancelTask()
    {

        if ($this->status !== self::STATUS_EXECUTION) {
            throw new Exception('Задачу в статусе "' . $this->status . '" отменить невозможно');
        }
        //Изменяю у задачи статус а базе
        $this->status = self::STATUS_CANCELED;
    }
}