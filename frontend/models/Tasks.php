<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property int $customer_id
 * @property int $category_id
 * @property int $executor_id
 * @property int $city_id
 * @property string $district
 * @property double $lat
 * @property double $long
 * @property string $name
 * @property string $description
 * @property int $sum
 * @property string $status
 * @property string $deadline
 * @property string $created
 * @property string $closed
 *
 * @property Chat[] $chats
 * @property Response[] $responses
 * @property Review[] $reviews
 * @property TaskFile[] $taskFiles
 * @property Category $category
 * @property User $customer
 * @property User $executor
 * @property City $city
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'category_id', 'name', 'description', 'created'], 'required'],
            [['customer_id', 'category_id', 'executor_id', 'city_id', 'sum'], 'integer'],
            [['lat', 'long'], 'number'],
            [['description', 'status'], 'string'],
            [['deadline', 'created', 'closed'], 'safe'],
            [['district'], 'string', 'max' => 200],
            [['name'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['executor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['executor_id' => 'id']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'category_id' => 'Category ID',
            'executor_id' => 'Executor ID',
            'city_id' => 'City ID',
            'district' => 'District',
            'lat' => 'Lat',
            'long' => 'Long',
            'name' => 'Name',
            'description' => 'Description',
            'sum' => 'Sum',
            'status' => 'Status',
            'deadline' => 'Deadline',
            'created' => 'Created',
            'closed' => 'Closed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChats()
    {
        return $this->hasMany(Chat::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Response::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaskFiles()
    {
        return $this->hasMany(TaskFile::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(User::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExecutor()
    {
        return $this->hasOne(User::className(), ['id' => 'executor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }
}
