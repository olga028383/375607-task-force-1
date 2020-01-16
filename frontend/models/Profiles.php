<?php

namespace app\models;

use frontend\models\Users;
use Yii;

/**
 * This is the model class for table "profiles".
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $avatar
 * @property string $birthday
 * @property string|null $biography
 * @property int|null $rating
 * @property int|null $view_count
 * @property int|null $order_count
 * @property string|null $phone
 * @property string|null $skype
 * @property string|null $other_connect
 * @property int|null $notification_message
 * @property int|null $notification_task_action
 * @property int|null $notification_reviews
 * @property int|null $show_contacts_customer
 * @property int|null $show_profile
 * @property string $last_active_at
 *
 * @property Users $user
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
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_id' => 'id']],
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
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }
}
