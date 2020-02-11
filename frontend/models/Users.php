<?php

namespace frontend\models;

use app\models\Profiles;
use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property int|null $city_id
 * @property string|null $district
 * @property float|null $lat
 * @property float|null $long
 * @property string $email
 * @property string $name
 * @property string $password
 * @property string $registered
 *
 * @property ChatMessages[] $chatMessages
 * @property ChatMessages[] $chatMessages0
 * @property Chats[] $chats
 * @property Events[] $events
 * @property FavouriteUsers[] $favouriteUsers
 * @property FavouriteUsers[] $favouriteUsers0
 * @property Photos[] $photos
 * @property Responses[] $responses
 * @property Reviews[] $reviews
 * @property Reviews[] $reviews0
 * @property Tasks[] $tasks
 * @property Tasks[] $tasks0
 * @property UserSpecializationCategory[] $userSpecializationCategories
 * @property UserSpecializationCategory[] $userSpecializationCategories0
 * @property Cities $city
 */
class Users extends \yii\db\ActiveRecord
{

    use TimeCreationToCurrentTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_id'], 'integer'],
            [['lat', 'long'], 'number'],
            [['email', 'name', 'password', 'registered'], 'required'],
            [['registered'], 'safe'],
            [['district'], 'string', 'max' => 200],
            [['email', 'name'], 'string', 'max' => 155],
            [['password'], 'string', 'max' => 525],
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
            'city_id' => 'City ID',
            'district' => 'District',
            'lat' => 'Lat',
            'long' => 'Long',
            'email' => 'Email',
            'name' => 'Name',
            'password' => 'Password',
            'registered' => 'Registered',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChatMessages()
    {
        return $this->hasMany(ChatMessages::class, ['sender_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChats()
    {
        return $this->hasMany(Chats::class, ['executor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Events::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFavouriteUsers()
    {
        return $this->hasMany(FavouriteUsers::class, ['user_current' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotos()
    {
        return $this->hasMany(Photos::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Responses::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Reviews::class, ['recipient_id' => 'id'])->joinWith('profile');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::class, ['executor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSpecializationCategories()
    {
        return $this->hasMany(UserSpecializationCategory::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::class, ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Categories::class, ['id' => 'categories_id'])
            ->viaTable('user_specialization_category', ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profiles::class, ['user_id' => 'id']);
    }
}
