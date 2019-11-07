<?php

namespace HtmlAcademy\Models;

use HtmlAcademy\Models\Actions;
use HtmlAcademy\Models\Ex\TaskForceException;

class TaskForce
{
    const STATUS_NEW = 'new';
    const STATUS_EXECUTION = 'on execution';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELED = 'canceled';
    const STATUS_FAILED = 'failed';

    const ROLE_CUSTOMER = 'customer';
    const ROLE_EXECUTOR = 'executor';

    private $taskId;
    private $categoryId;

    private $customerId;
    private $executorId;

    private $cityId;
    private $district;
    private $lat;
    private $long;

    private $name;
    private $description;
    private $sum;
    private $dateDeadline;
    private $dateCreated;
    private $dateClosed;

    private $files;
    private $status;

    /**
     * TaskForce constructor.
     * @param int $taskId
     * @param int $categoryId
     * @param int $customerId
     * @param int $cityId
     * @param float $lat
     * @param float $long
     * @param string $name
     * @param string $description
     * @param int $sum
     * @param string $dateDeadline
     * @param string $dateCreated
     * @param string $status
     * @param int $executorId
     * @param string $district
     * @param array $files
     */
    private function __construct(
        int $taskId,
        int $categoryId,
        int $customerId,
        string $name,
        string $description,
        int $sum,
        string $dateDeadline,
        string $dateCreated,
        string $status = '',
        int $executorId = null,
        int $cityId = null,
        float $lat = null,
        float $long = null,
        string $district = '',
        array $files = array())
    {
        $this->taskId = $taskId;
        $this->categoryId = $categoryId;
        $this->customerId = $customerId;
        $this->name = $name;
        $this->description = $description;
        $this->sum = $sum;
        $this->dateDeadline = $dateDeadline;
        $this->dateCreated = $dateDeadline;
        $this->executorId = $executorId;
        $this->cityId = $cityId;
        $this->lat = $lat;
        $this->long = $long;
        $this->district = $district;
        $this->files = $files;

        if (!$status) {
            $this->status = self::STATUS_NEW;
        } else {
            $this->status = $status;
        }

    }

    /**
     * Функция возвращает текущий статус
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Функция возвращает идентификатор заказчика
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    /**
     * Функция возвращает текущего исполнителя или null если он не выбран
     * @return int|null
     */
    public function getExecutorId():?int
    {
        return $this->executorId;
    }

    /**
     * Функция возвращает дату закрытия задачи или null, если она не добавлена
     * @return null|string
     */
    public function getDateClosed():?string
    {
        return $this->dateClosed;
    }

    /**
     * Метод возвращает все действия
     * @return array
     */
    public function getActions(): array
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
    public function getStatuses(): array
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
     * @param int $categoryId
     * @param int $customerId
     * @param int $cityId
     * @param float $lat
     * @param float $long
     * @param string $name
     * @param string $description
     * @param int $sum
     * @param string $dateDeadline
     * @param string $dateCreated
     * @param string $status
     * @param int $executorId
     * @param string $district
     * @param array $files
     * @return object
     * @throws TaskForceException
     */
    public static function createTask(
        int $categoryId,
        int $customerId,
        string $name,
        string $description,
        int $sum,
        string $dateDeadline,
        string $dateCreated,
        string $status = '',
        int $executorId = null,
        int $cityId = null,
        float $lat = null,
        float $long = null,
        string $district = '',
        array $files = array()
    ): TaskForce
    {
        if (!$categoryId) {
            throw new TaskForceException('Не передан id категории');
        }

        if (!$customerId) {
            throw new TaskForceException('Не передан id заказчика');
        }

        if (!$name) {
            throw new TaskForceException('Не передано название задачи');
        }

        if (!$sum) {
            throw new TaskForceException('Не передана сумма');
        }

        $taskId = 1;

        $object = new TaskForce($taskId, $categoryId, $customerId, $name, $description, $sum, $dateDeadline, $dateCreated, $status, $executorId, $cityId, $lat, $long, $district, $files);
        return $object;
    }

    /**
     * @param int $taskId
     * @return object
     * @throws TaskForceException
     */
    public static function getTask(int $taskId): TaskForce
    {
        //Получаю задачу из базы и создаю объект иначе выбрасываю исключение
        if (!$taskId) {
            throw new TaskForceException('Такой задачи не существует');
        }

        $taskId = 1;
        $categoryId = 1;
        $customerId = 1;
        $cityId = 1;
        $lat = 55.703019;
        $long = 37.530859;
        $name = 'Убрать квартиру';
        $description = 'Убрать квартру в понедельник';
        $sum = 5000.00;
        $dateDeadline = '18.11.2019';
        $dateCreated = '30.10.2019';
        $status = 'new';
        $executorId = 0;
        $district = '';
        $files = array();

        $object = new TaskForce($taskId, $categoryId, $customerId, $name, $description, $sum, $dateDeadline, $dateCreated, $status, $executorId, $cityId, $lat, $long, $district, $files);
        return $object;
    }

    /**
     * Метод возвращает статус, в зависимости от действия
     * @param $action
     * @return string
     */
    public function getNextStatus($action): string
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
                throw new TaskForceException('Передено неизвестное действие.');
        }

        return $status;
    }

    /**
     * Возвращает список действий в зависимости от статуса задачи и роли пользователя
     * @param int $userId
     * @return array
     * @throws TaskForceException
     */
    public function getAvailableActions(int $userId): array
    {

        $actions = array();

        foreach ($this->getActions() as $action) {

            if (!class_exists($action)) {
                throw new TaskForceException('Класс ' . $action . ' не существует');
            }

            if (!method_exists($action, 'checkRightsUser')) {
                throw new TaskForceException('Метод "checkRightsUser" не существует');
            }

            if (!method_exists($action, 'getCodeName')) {
                throw new TaskForceException('Метод "getCodeName" не существует');
            }

            if ($action::checkRightsUser($userId, $this)) {
                $actions[] = $action::getCodeName();
            }
        }

        return $actions;
    }

    /**
     * @param int $executorId
     * @param string $comments
     * @param int $sum
     */
    public function addResponse(int $executorId): void
    {
        if (!$executorId) {
            throw new TaskForceException('Не передан идентификатор исполнителя');
        }
        $this->executorId = $executorId;
        //Добавить отклик к задаче
        //Будет какая-то таблица откликов с id задачи
    }

    /**
     * Задача выполняется, присваивается исполнитель
     * @param int $executorId
     * @throws TaskForceException
     */
    public function beginTask(int $executorId): void
    {
        if (!$executorId) {
            throw new TaskForceException('Не передан идентификатор исполнителя');
        }
        //Добавляет  базу к задаче исполнителя и присваиваем новый статус
        $this->executorId = $executorId;
        $this->status = self::STATUS_EXECUTION;
    }

    /**
     * Метод говорит о том, что задача выполнена
     */
    public function completeTask(): void
    {
        $this->status = self::STATUS_COMPLETED;
    }

    /**
     * Метод изменяет статус провеленной задачи
     */
    public function failTask(): void
    {
        //Изменяет в таблице данные пользователя, счетчик провалов
        //Отвязать исполнителя от задачи?
        $this->status = self::STATUS_FAILED;
    }

    /**
     * @param int $userId
     * @throws TaskForceException
     */
    public function cancelTask(int $userId): void
    {

        if (!Actions\CancelAction::checkRightsUser($userId, $this)) {
            throw new TaskForceException('Задачу в статусе "' . $this->status . '" отменить невозможно');
        }
        //Изменяю у задачи статус а базе
        $this->status = self::STATUS_CANCELED;
    }
}