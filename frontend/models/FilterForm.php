<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12.12.2019
 * Time: 19:37
 */

namespace frontend\models;


use yii\base\Model;

class FilterForm extends Model
{
    /**
     * @var
     */
    public $categories;

    /**
     * @var
     */
    public $withoutExecutor;

    /**
     * @var
     */
    public $distantWork;
    /**
     * @var
     */
    public $time;

    /**
     * @var
     */
    public $search;

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'categories' => 'Категории',
            'withoutExecutor' => 'Без исполнителя',
            'distantWork' => 'Удаленная работа',
            'time' => 'Период',
            'search' => 'Поиск',
        ];
    }


}