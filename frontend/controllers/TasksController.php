<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 28.11.2019
 * Time: 8:50
 */

namespace frontend\controllers;

use frontend\models\FilterForm;
use frontend\models\Tasks;
use HtmlAcademy\Models\TaskForce;
use Yii;
use yii\web\Controller;

class TasksController extends Controller
{

    /**
     *
     */
    public function actionIndex()
    {
        $filterFormModel = new FilterForm();
        $request = Yii::$app->request;

        $query = Tasks::find()
            ->with(['category', 'city'])
            ->where(['status' => TaskForce::STATUS_NEW]);


        if ($request->getIsPost()) {

            $post = $request->post();

            foreach ($post["FilterForm"] as $name => $data) {

                switch ($name) {
                    case 'categories':
                        $query->andWhere(['category_id' => $data]);
                        break;
                    case 'withoutExecutor':
                        $query->andWhere(['executor_id' => NULL]);
                        break;
                }
            }
        }

        $tasks = $query->andWhere(['>', 'created', 'deadline'])
            ->orderBy(['created' => SORT_DESC])
            ->all();

        return $this->render('browse', [
            'tasks' => $tasks,
            'filterFormModel' => $filterFormModel
        ]);

    }
}