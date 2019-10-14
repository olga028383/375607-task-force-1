<?php

class TaskForce
{
    const STATUS_NEW = 'new';
    const STATUS_START = 'start';
    const STATUS_CLOSED = 'closed';
    const STATUS_FAILED = 'failed';
    const STATUS_CANCELED = 'canceled';

    const RIGHTS_CUSTOMER = 'customer';
    const RIGHTS_EXECUTOR = 'executor';

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
    private function __construct($customerId, $name, $description, $categoryId, $files, $cityId, $coordinates, $sum, $dateClosed, $status, $taskId, $executorId)
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
        $this->executorId = $taskId;

        if (!$status) {
            $this->status = self::STATUS_NEW;
        } else {
            $this->status = $status;
        }

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
    public static function createTask($customerId, $name, $description, $categoryId, $files = array(), $cityId, $coordinates, $sum, $dateClosed, $status, $executorId)
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

        $object = new TaskForce($customerId, $name, $description, $categoryId, $files, $cityId, $coordinates, $sum, $dateClosed, $status = '', $taskId, $executorId = '');
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
        $status = '';

        switch ($action) {
            case self::ACTION_ADD:
                $status = self::STATUS_NEW;
                break;
            case self::ACTION_RESPOND:
                $status = self::STATUS_NEW;
                break;
            case self::ACTION_BEGIN:
                $status = self::STATUS_START;
                break;
            case self::ACTION_CLOSE:
                $status = self::STATUS_CLOSED;
                break;
            case self::ACTION_FAIL:
                $status = self::STATUS_FAILED;
                break;
            case self::ACTION_CANCEL:
                $status = self::STATUS_CANCELED;
                break;
            case self::ACTION_SEND:
                //ут не поняла какой статус возвращать
                $status = self::STATUS_NEW;
                break;
        }

        return $status;
    }

    /**
     * Возвращает список действий в зависимости от статуса задачи и роли пользователя
     * @param $userRole
     * @return array
     */
    public function getAvailableActions($userRole)
    {
        $actions = array();

        if ($userRole === self::RIGHTS_CUSTOMER) {

            switch ($this->status) {
                case self::STATUS_NEW:
                    $actions = array(self::ACTION_CANCEL, self::ACTION_CLOSE);
                    break;
                case self::STATUS_FAILED:
                    $actions = array(self::ACTION_CANCEL, self::ACTION_CLOSE);
                    break;
                case self::STATUS_CANCELED:
                    $actions = array(self::ACTION_CLOSE);
                    break;
            }
        } else if ($userRole === self::RIGHTS_EXECUTOR) {

            switch ($this->status) {
                case self::STATUS_NEW:
                    $actions = array(self::ACTION_RESPOND, self::ACTION_BEGIN);
                    break;
                case self::STATUS_START:
                    $actions = array(self::ACTION_CLOSE, self::ACTION_FAIL);
                    break;

            }
        }

        return $actions;
    }

    /**
     * Метод возвращает все действия
     * @return array
     */
    public function getActions()
    {
        return array(
            self::ACTION_ADD,
            self::ACTION_RESPOND,
            self::ACTION_BEGIN,
            self::ACTION_CLOSE,
            self::ACTION_FAIL,
            self::ACTION_CANCEL,
            self::ACTION_SEND
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
            self::STATUS_START,
            self::STATUS_CANCELED,
            self::STATUS_CLOSED,
            self::STATUS_FAILED
        );
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

        if ($this->status !== self::STATUS_START || $this->status !== self::STATUS_CLOSED) {
            $this->errors[] = 'Задачу в статусе "' . $this->status . '" отменить невозможно';
            return $this->errors;
        }
        //Изменяю у задачи статус а базе
        $this->status = self::STATUS_CANCELED;
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
    public function getCustomerID()
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
}