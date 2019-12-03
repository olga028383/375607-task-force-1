<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 28.11.2019
 * Time: 8:50
 */

namespace frontend\controllers;

use frontend\models\Categories;
use frontend\models\Tasks;
use HtmlAcademy\Models\TaskForce;
use yii\web\Controller;

class TaskController extends Controller
{

    /**
     *
     */
    public function actionIndex(){

        $tasks = Tasks::find()
            ->with(['category', 'city'])
            ->where(['status' => TaskForce::STATUS_NEW])
            ->orderBy('id')
            ->all();

        return $this->render('browse', [
            'tasks' => $tasks,
        ]);


    }
}