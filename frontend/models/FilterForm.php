<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12.12.2019
 * Time: 19:37
 */

namespace frontend\models;


use yii\base\Model;
use yii\base\ErrorException;

class FilterForm extends Model
{
    /**
     * @var
     */
    public $categories = array();

    /**
     * @var
     */
    public $myCity;

    /**
     * @var
     */
    public $distantWork;

    /**
     * @var
     */
    public $availableTime = array(
        'day' => 'За день',
        'week' => 'За неделю',
        'month' => 'За месяц'
    );

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
            'myCity' => 'Мой город',
            'distantWork' => 'Удаленная работа',
            'time' => 'Период',
            'search' => 'Поиск',
        ];
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['categories', 'myCity', 'distantWork', 'time', 'search'], 'safe'],
        ];
    }

    /**
     * @param string $period
     * @return string
     * @throws ErrorException
     */
    public function getStartDateOfPeriod(string $period): string
    {
        if (!array_key_exists($period, $this->availableTime)) {
            throw new ErrorException('Данного периода нет в массиве');
        }

        $current = new \DateTime();
        $current->sub(\DateInterval::createFromDateString('1 ' . $period));
        return $current->format('Y-m-d H:i:s');
    }


}