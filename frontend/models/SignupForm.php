<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    /**
     * @var
     */
    public $username;

    /**
     * @var
     */
    public $email;

    /**
     * @var
     */
    public $password;

    /**
     * @var
     */
    public $city;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password', 'city'], 'required', 'message' => 'Это поле обязательно для заполнения'],

            ['username', 'trim'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\frontend\models\Users', 'message' => 'Введите валидный адрес электронной почты'],

            ['password', 'string', 'min' => 8, 'message' => 'Пароль должен быть не менее 8 символов'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Ваше имя',
            'email' => 'Электронная почта',
            'password' => 'Пароль',
            'city' => 'Город проживания',
        ];
    }

    /**
     * Signs user up
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new Users();
        $user->name = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->city_id = $this->city;
        $user->registered = gmdate("Y-m-d H:i:s");
        return $user->save();
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
