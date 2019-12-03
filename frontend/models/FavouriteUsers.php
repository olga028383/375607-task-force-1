<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "favourite_users".
 *
 * @property int $id
 * @property int|null $user_current
 * @property int|null $user_added
 *
 * @property Users $userCurrent
 * @property Users $userAdded
 */
class FavouriteUsers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favourite_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_current', 'user_added'], 'integer'],
            [['user_current'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_current' => 'id']],
            [['user_added'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_added' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_current' => 'User Current',
            'user_added' => 'User Added',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserCurrent()
    {
        return $this->hasOne(Users::class, ['id' => 'user_current']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAdded()
    {
        return $this->hasOne(Users::class, ['id' => 'user_added']);
    }
}
