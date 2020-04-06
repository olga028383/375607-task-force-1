<?php

namespace frontend\models;

use HtmlAcademy\Models\TaskForce;
use yii\base\Model;

class TaskForm extends Model
{
    public $name;
    public $customer_id;
    public $description;
    public $category;
    public $files = array();
    public $city;
    public $sum;
    public $deadline;

    public function rules()
    {
        return [
            [['name', 'description'], 'filter', 'filter' => function ($value) {
                return preg_replace("/\s+/", "", $value);
            }],

            [['name', 'description'], 'required', 'message' => 'Это поле должно быть заполнено'],

            ['name', 'string', 'length' => [10]],
            ['description', 'string', 'length' => [60]],

            ['category',  'required', 'message' => 'Это поле должно быть выбрано. Задание должно принадлежать одной из категорий'],
            ['category', 'validateCategory'],

            ['sum', 'number', 'min' => 0, 'message' => 'Поле должно быть целым положительным числом'],

            //Вот тут вопрос, в задании формат даты проверяется такой DD.MM.YY, а в базе у нас хранится такой 2019-11-15 00:00:, так какой формат проверять?
            ['deadline', 'date', 'format' => 'php:Y-m-d H:i:s']
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Мне нужно',
            'description' => 'Подробности задания',
            'category' => 'Категория',
            'files' => 'Файлы',
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


    public function createTask()
    {
        if (!$this->validate()) {
            return null;
        }

        $tasks = new Tasks();
        $tasks->customer_id = $this->customer_id;
        $tasks->name = $this->name;
        $tasks->description = $this->description;
        $tasks->category_id = $this->category;
        $tasks->sum = $this->sum;
        $tasks->created = gmdate("Y-m-d H:i:s");
        $tasks->deadline = $this->deadline;
        $tasks->status = TaskForce::STATUS_NEW;
        return $tasks->save();
    }
}