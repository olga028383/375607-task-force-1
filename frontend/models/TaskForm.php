<?php

namespace frontend\models;

use HtmlAcademy\Models\TaskForce;
use Yii;
use yii\base\Model;
use yii\helpers\FileHelper;

class TaskForm extends Model
{
    public $name;
    public $description;
    public $category;
    public $files = array();
    public $city;
    public $sum;
    public $deadline;

    private $filesPath = array();

    public function rules()
    {
        return [

            [['name', 'description'], 'filter', 'filter' => function ($value) {
                return preg_replace("/\s+/", "", $value);
            }],

            [['name', 'description'], 'required', 'message' => 'Это поле должно быть заполнено'],

            ['name', 'string', 'length' => [10]],
            ['description', 'string', 'length' => [60]],

            ['category', 'required', 'message' => 'Это поле должно быть выбрано. Задание должно принадлежать одной из категорий'],
            ['category', 'validateCategory'],

            ['sum', 'number', 'min' => 0, 'message' => 'Поле должно быть целым положительным числом'],

            //Вот тут вопрос, в задании формат даты проверяется такой DD.MM.YY, а в базе у нас хранится такой 2019-11-15 00:00:, так какой формат проверять?
//            ['deadline', 'filter', 'filter' => function ($value) {
//                return preg_replace("/\s+/", "", $value);
//            }],
//            ['deadline', 'date', 'format' => 'php:yyyy-mm-dd']

            ['files' ,'safe']
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
     * Функция, проверяет, что категория существует
     */
    public function validateCategory()
    {
        $category = Categories::find()
            ->where(['id' => $this->category])
            ->one();

        if (!$category) {
            $this->addError('category', 'Категория не существует');
        }
    }

    public function upload()
    {
        if ($this->validate()) {

            $dir = Yii::getAlias('@app/uploads');

            if (!file_exists($dir)) {
                FileHelper::createDirectory($dir);
            }

            $path = $dir . '/' . $this->file->baseName . '.' . $this->file->extension;
            $this->file->saveAs($path);

            return $path;
        }

        return false;

    }

    public function createTask()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = Yii::$app->user->getIdentity();

        if (!$user->getId()) {
            return null;
        }

        $tasks = new Tasks();
        $tasks->customer_id = $user->getId();
        $tasks->name = $this->name;
        $tasks->description = $this->description;
        $tasks->category_id = $this->category;
        $tasks->sum = $this->sum;
        $tasks->created = gmdate("Y-m-d H:i:s");
        $tasks->deadline = $this->deadline;
        $tasks->status = TaskForce::STATUS_NEW;
        return $tasks->save();
    }

    public function addFiles(int $idTask)
    {

        foreach ($this->files as $file) {
            $fileTask = new TaskFiles();
            $fileTask->task_id = $idTask;
            $fileTask->link = $file;
            return $fileTask->save();
        }
    }

}