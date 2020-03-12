<?php

namespace frontend\controllers;

use Yii;
use yii\bootstrap\ActiveForm;
use yii\web\Controller;
use frontend\models\LoginForm;
use yii\web\Response;

/**
 * Class LandingController
 * @package frontend\controllers
 */
class LandingController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * @return array|string|Response
     */
    public function actionIndex()
    {
        $this->layout = 'layout';

        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['/tasks']);
        }

        $model = new LoginForm();

        if (\Yii::$app->request->getIsPost()) {
            $model->load(\Yii::$app->request->post());

            if ($model->validate()) {
                $user = $model->getUser();
                Yii::$app->user->login($user);
                return $this->redirect(['/tasks']);
            } else {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }


        return $this->renderAjax('@app/views/layouts/layout.php', [
            'model' => $model,
        ]);
    }

    /**
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
