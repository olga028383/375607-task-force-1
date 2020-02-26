<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 17.02.2020
 * Time: 8:53
 */

namespace frontend\controllers;


use frontend\models\SignupForm;
use Yii;
use yii\web\Controller;

class SignupController extends Controller
{
    /**
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);

    }
}