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

        if($request->getIsPost()) {

            $post = $request->post();

            $query = (new \yii\db\Query())
                ->from('tasks')
                ->leftJoin('categories', 'categories.id = tasks.category_id')
                ->leftJoin('cities', 'cities.id = tasks.city_id');

            foreach($post["FilterForm"] as $name => $data){

                switch($name)
                {
                    case 'categories':
                        $query->andFilterWhere(['category_id' => $data]);
                    break;
                    case 'withoutExecutor':
                        $query->andFilterWhere(['executor_id' => NULL]);
                        break;
                }
            }

            $tasks = $query->all();
            //dump($tasks);


        }else{

            $tasks = Tasks::find()
                ->with(['category', 'city'])
                ->where(['status' => TaskForce::STATUS_NEW])
                ->andWhere(['>', 'created', 'deadline'])
                ->orderBy(['created' => SORT_DESC])
                ->all();
        }


        return $this->render('browse', [
            'tasks' => $tasks,
            'filterFormModel' => $filterFormModel
        ]);

    }
}