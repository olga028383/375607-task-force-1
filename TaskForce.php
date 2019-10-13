<?php

class TaskForce
{
    const STATUS_NEW = 'new';
    const STATUS_START = 'start';
    const STATUS_CLOSED = 'closed';
    const STATUS_FAILED = 'failed';
    const STATUS_CANCELED = 'canceled';

    const RIGHTS_R = 'R';
    const RIGHTS_W = 'W';

    const ACTION_ADD = 'add';
    const ACTION_RESPOND = 'respond';
    const ACTION_BEGIN = 'begin';
    const ACTION_CLOSE = 'close';
    const ACTION_FAIL = 'fail';
    const ACTION_CANCEL = 'cancel';
    const ACTION_SEND = 'send';

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
     * Метод добавляет задачу
     */
    public static function createTask($customerId, $name, $description, $categoryId, $files = array(), $cityId, $coordinates, $sum, $dateClosed, $status)
    {
        //Добавляю задачу в базу, получаю данные и создаю объект
        //вот тут не поняла как положить статус базу, если константа не доступна, пока оставляю статус пустым

        $customerId = 1;
        $name = 'Убрать квартиру';
        $description = 'Убрать квартру в понедельник';
        $categoryId = "Уборка";
        $cityId = 1;
        $coordinates = array(55.703019, 37.530859);
        $sum = 5000.00;
        $dateClosed = 18.10;
        $taskId = 1;

        $object = new TaskForce($customerId, $name, $description, $categoryId, $files, $cityId, $coordinates, $sum, $dateClosed, $status = '', $taskId);
        return $object;
    }

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

        $object = new TaskForce($customerId, $name, $description, $categoryId, $files, $cityId, $coordinates, $sum, $dateClosed, $taskId);
        return $object;
    }

    public function addResponse($executorId, $evaluation, $comments, $sum)
    {
        //Добавить отклик к задаче
        //Будет какая-то таблица откликов с id задачи
    }

    /**
     * Задача выполняется, присваивается исполнитель
     */
    public function beginTask($executorId)
    {
        //Добавляет  базу к задаче исполнителя и присваиваем новый статус
        $this->executorId = $executorId;
        $this->status = self::STATUS_START;
    }

    /**
     * Метод закрывает задачу
     */
    public function closeTask()
    {
        //Не очень поняла по т/з что именно будет происходить
        $this->status = self::STATUS_CLOSED;
    }

    public function failTask()
    {
        //Изменяет в таблице данные пользователя, счетчик провалов
        //Отвязать исполнителя от задачи?
        $this->status = self::STATUS_FAILED;
    }

    public function cancelTask()
    {

        if ($this->status !== self::STATUS_START || $this->status !== self::STATUS_CLOSED) {
            $this->errors[] = 'Задачу в статусе "' . $this->status . '" отменить невозможно';
            return $this->errors;
        }
        //Изменяю у задачи статус а базе
        $this->status = self::STATUS_CANCELED;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getCustomerID()
    {
        return $this->customerId;
    }

    public function getExecutorId()
    {
        return $this->executorId;
    }

    public function getDateClosed()
    {
        return $this->dateClosed;
    }
}