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
        '1 day' => 'За день',
        '1 week' => 'За неделю',
        '1 month' => 'За месяц'
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
     * @var
     */
    public $free;

    /**
     * @var
     */
    public $online;

    /**
     * @var
     */
    public $withReviews;

    /**
     * @var array
     */
    private $availablePeriod = array(
        '1 day',
        '1 week',
        '1 month',
        '30 minutes'
    );

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
            'free' => 'Сейчас свободен',
            'online' => 'Сейчас онлайн',
            'withReviews' => 'Есть отзывы'
        ];
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['categories', 'myCity', 'distantWork', 'time', 'search', 'free', 'online', 'withReviews'], 'safe'],
        ];
    }

    /**
     * @param string $period
     * @return string
     * @throws ErrorException
     */
    public function getStartDateOfPeriod(string $period): string
    {
        if (!in_array($period, $this->availablePeriod)) {
            throw new ErrorException('Данного периода нет в массиве');
        }

        $current = new \DateTime();
        $current->sub(\DateInterval::createFromDateString($period));
        return $current->format('Y-m-d H:i:s');
    }


}