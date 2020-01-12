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

    public function actionIndex()
    {
        $filterFormModel = new FilterForm();
        $filterFormModel->load($_POST);

        $query = Tasks::find()
            ->with(['category', 'city'])
            ->where(['status' => TaskForce::STATUS_NEW])
            ->andWhere('deadline > created');


        foreach ($filterFormModel as $key => $data) {
            if ($data) {

                switch ($key) {
                    case 'categories':
                        $query->andWhere(['category_id' => $data]);
                        break;
                    case 'myCity':
                        //Не обрабатывала, т как пока не работали с пользователями
                        break;
                    case 'distantWork':
                        $query->andWhere(['city_id' => NULL]);
                        break;
                    case 'time':
                        $query->andWhere(['>', 'created', $filterFormModel->getStartDateOfPeriod($data)]);
                        break;
                        break;
                    case 'search':
                        $query->andWhere(['LIKE', 'name', $data]);
                        break;

                }
            }

        }

        $tasks = $query->orderBy(['created' => SORT_DESC])
            ->all();

        return $this->render('browse', [
            'tasks' => $tasks,
            'filterFormModel' => $filterFormModel
        ]);

    }
}