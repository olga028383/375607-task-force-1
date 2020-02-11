<?php

namespace frontend\models;

use app\models\Profiles;
use Yii;
use yii\db\ActiveQuery;
use yii\debug\models\search\Profile;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property int $customer_id
 * @property int $category_id
 * @property int|null $executor_id
 * @property int|null $city_id
 * @property string|null $district
 * @property float|null $lat
 * @property float|null $long
 * @property string $name
 * @property string $description
 * @property int|null $sum
 * @property string|null $status
 * @property string|null $deadline
 * @property string $created
 * @property string|null $closed
 *
 * @property Chats[] $chats
 * @property Responses[] $responses
 * @property Reviews[] $reviews
 * @property TaskFiles[] $taskFiles
 * @property Categories $category
 * @property Users $customer
 * @property Users $executor
 * @property Cities $city
 */
class Tasks extends \yii\db\ActiveRecord
{
    use TimeCreationToCurrentTrait;

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
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::class, 'targetAttribute' => ['category_id' => 'id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['customer_id' => 'id']],
            [['executor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['executor_id' => 'id']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::class, 'targetAttribute' => ['city_id' => 'id']],
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
        return $this->hasMany(Chats::class, ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Responses::class, ['task_id' => 'id'])->with('user');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Reviews::class, ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaskFiles()
    {
        return $this->hasMany(TaskFiles::class, ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::class, ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Users::class, ['id' => 'customer_id'])
            ->with('profile','tasksCustomer');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExecutor()
    {
        return $this->hasOne(Users::class, ['id' => 'executor_id'])
            ->with('profile');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::class, ['id' => 'city_id']);
    }

}