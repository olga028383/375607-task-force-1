<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property int $city_id
 * @property string $district
 * @property double $lat
 * @property double $long
 * @property string $email
 * @property string $name
 * @property string $password
 * @property string $registered
 *
 * @property ChatMessage[] $chatMessages
 * @property ChatMessage[] $chatMessages0
 * @property Chat[] $chats
 * @property Event[] $events
 * @property FavouriteUser[] $favouriteUsers
 * @property FavouriteUser[] $favouriteUsers0
 * @property Photo[] $photos
 * @property Response[] $responses
 * @property Review[] $reviews
 * @property Review[] $reviews0
 * @property Task[] $tasks
 * @property Task[] $tasks0
 * @property UserSpecializationCategory[] $userSpecializationCategories
 * @property UserSpecializationCategory[] $userSpecializationCategories0
 * @property City $city
 */
class Users extends \yii\db\ActiveRecord
{
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
        return $this->hasMany(ChatMessage::className(), ['sender_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChatMessages0()
    {
        return $this->hasMany(ChatMessage::className(), ['recipient_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChats()
    {
        return $this->hasMany(Chat::className(), ['executor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFavouriteUsers()
    {
        return $this->hasMany(FavouriteUser::className(), ['user_current' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFavouriteUsers0()
    {
        return $this->hasMany(FavouriteUser::className(), ['user_added' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotos()
    {
        return $this->hasMany(Photo::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Response::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['sender_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews0()
    {
        return $this->hasMany(Review::className(), ['recipient_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks0()
    {
        return $this->hasMany(Task::className(), ['executor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSpecializationCategories()
    {
        return $this->hasMany(UserSpecializationCategory::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSpecializationCategories0()
    {
        return $this->hasMany(UserSpecializationCategory::className(), ['categories_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }
}
