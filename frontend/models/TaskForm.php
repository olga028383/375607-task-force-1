<?php

namespace frontend\models;

use HtmlAcademy\Models\TaskForce;
use Yii;
use yii\base\Model;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class TaskForm extends Model
{
    public $name;
    public $description;
    public $category;
    public $files;
    public $city;
    public $sum;
    public $deadline;

    public function rules()
    {
        return [

            [['name', 'description'], 'required', 'message' => 'Это поле должно быть заполнено'],
            [['name', 'description'], 'trim'],

            ['name', 'string', 'length' => [10]],
            ['description', 'string', 'length' => [60]],

            ['category', 'required', 'message' => 'Это поле должно быть выбрано. Задание должно принадлежать одной из категорий'],
            ['category', 'exist', 'skipOnError' => false, 'targetClass' => \frontend\models\Categories::class, 'targetAttribute' => ['category' => 'id']],

            ['sum', 'number', 'min' => 0, 'message' => 'Поле должно быть целым положительным числом'],

            //Вот здесь должна была быть проверка на ДД.ММ.ГГГГ, я сделала наоборот, т как встроенныей input type['date'], возвращает такую дату 2020-05-09
            ['deadline', 'date', 'format' => 'yyyy-MM-dd', 'min' => time(),  'message' => 'Неверный формат даты', 'tooSmall' => 'Дедлайн должен быть больше текущей даты'],

            ['files', 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Мне нужно',
            'description' => 'Подробности задания',
            'category' => 'Категория',
            'city' => 'Локация',
            'sum' => 'Бюджет',
            'deadline' => 'Срок исполнения'
        ];
    }

    /**
     * @param int $task_id
     * @throws \Exception
     */
    private function upload(int $task_id): void
    {
        $this->files = UploadedFile::getInstances($this, 'files');

        if (!empty($this->files)) {

            foreach ($this->files as $file) {

                $dir = Yii::getAlias('@frontend/uploads');

                if (!file_exists($dir)) {
                    FileHelper::createDirectory($dir);
                }

                $filename = sprintf('%s_%s.%s', $task_id, $file->baseName, $file->extension);

                if (!$this->addFile($task_id, $filename) || !$file->saveAs(sprintf('%s/%s', $dir, $filename))) {
                    throw new \Exception("Не удалось сохранить $filename в базу");
                }
            }
        }

    }

    /**
     * @throws \yii\web\ServerErrorHttpException
     */
    public function createTask(): void
    {

        $user = Yii::$app->user->getIdentity();

        if (!$user_id = $user->getId()) {
            throw new \Exception("Не получен идентификатор пользователя");
        }

        $transaction = Yii::$app->db->beginTransaction();

        try {

            $task = new Tasks();
            $task->name = $this->name;
            $task->description = $this->description;
            $task->category_id = $this->category;
            $task->city = $this->city;
            //чтобы не забыть - в дальнейшем добавление координат
            $task->sum = $this->sum;
            $task->created = gmdate("Y-m-d H:i:s");
            $task->deadline = $this->deadline;
            $task->customer_id = $user_id;
            $task->status = TaskForce::STATUS_NEW;
            $task->save();

            $this->upload($task->id);

            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollback();
            throw new \yii\web\ServerErrorHttpException("Извините, при сохранении произошла ошибка");
        }
    }

    /**
     * @param int $idTask
     * @param string $link
     * @return bool
     */
    private function addFile(int $idTask, string $link): bool
    {
        $fileTask = new TaskFiles();
        $fileTask->task_id = $idTask;
        $fileTask->link = $link;
        return $fileTask->save();
    }

}