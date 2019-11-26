<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "profiles".
 *
 * @property int $id
 * @property int $user_id
 * @property string $avatar
 * @property string $birthday
 * @property string $biography
 * @property int $rating
 * @property int $view_count
 * @property int $order_count
 * @property string $phone
 * @property string $skype
 * @property string $other_connect
 * @property int $notification_message
 * @property int $notification_task_action
 * @property int $notification_reviews
 * @property int $show_contacts_customer
 * @property int $show_profile
 * @property string $last_active_at
 *
 * @property Category $user
 */
class Profiles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profiles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'birthday', 'last_active_at'], 'required'],
            [['user_id', 'rating', 'view_count', 'order_count', 'notification_message', 'notification_task_action', 'notification_reviews', 'show_contacts_customer', 'show_profile'], 'integer'],
            [['birthday', 'last_active_at'], 'safe'],
            [['biography'], 'string'],
            [['avatar', 'phone', 'skype'], 'string', 'max' => 100],
            [['other_connect'], 'string', 'max' => 200],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'avatar' => 'Avatar',
            'birthday' => 'Birthday',
            'biography' => 'Biography',
            'rating' => 'Rating',
            'view_count' => 'View Count',
            'order_count' => 'Order Count',
            'phone' => 'Phone',
            'skype' => 'Skype',
            'other_connect' => 'Other Connect',
            'notification_message' => 'Notification Message',
            'notification_task_action' => 'Notification Task Action',
            'notification_reviews' => 'Notification Reviews',
            'show_contacts_customer' => 'Show Contacts Customer',
            'show_profile' => 'Show Profile',
            'last_active_at' => 'Last Active At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Category::className(), ['id' => 'user_id']);
    }
}
