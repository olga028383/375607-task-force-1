<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 28.11.2019
 * Time: 8:50
 */

namespace frontend\controllers;

use frontend\models\FilterForm;
use frontend\models\TaskForm;
use frontend\models\Tasks;
use frontend\models\Users;
use HtmlAcademy\Models\TaskForce;
use Yii;
use yii\data\Pagination;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

/**
 * Class TasksController
 * @package frontend\controllers
 */
class TasksController extends SecuredController
{
    /**
     * @return array
     */
    public function behaviors()
    {
        $rules = parent::behaviors();
        $rule = [
            'allow' => false,
            'actions' => ['create'],
            'matchCallback' => function ($rule, $action) {
                return !Users::isUserCustomer(Yii::$app->user->id);
            },
            'denyCallback' => function ($rule, $action) {
                throw new ForbiddenHttpException('Извините, только заказчики могут создавать задачи');
            }
        ];
        array_unshift($rules['access']['rules'], $rule);

        return $rules;
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $filterFormModel = new FilterForm();
        $filterFormModel->load(Yii::$app->request->get());

        $query = Tasks::find()
            ->with(['category', 'city'])
            ->where(['status' => TaskForce::STATUS_NEW])
            ->andWhere('deadline > tasks.created');


        foreach ($filterFormModel as $key => $data) {
            if ($data) {

                switch ($key) {
                    case 'categories':
                        $query->andWhere(['category_id' => $data]);
                        break;
                    case 'withoutResponse':
                        $query->joinWith('responses');
                        $query->andWhere(['responses.user_id' => NULL]);
                        break;
                    case 'distantWork':
                        $query->andWhere(['city_id' => NULL]);
                        break;
                    case 'time':
                        $query->andWhere(['>', 'tasks.created', $filterFormModel->getStartDateOfPeriod($data)]);
                        break;
                        break;
                    case 'search':
                        $query->andWhere(['LIKE', 'name', $data]);
                        break;

                }
            }

        }

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $tasks = $query->orderBy(['tasks.created' => SORT_DESC])
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();


        return $this->render('browse', [
            'tasks' => $tasks,
            'pages' => $pages,
            'filterFormModel' => $filterFormModel
        ]);

    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {

        $task = Tasks::find()
            ->where(['tasks.id' => $id])
            ->with('category', 'taskFiles', 'customer', 'responses')
            ->one();

        if (!$task) {
            throw new NotFoundHttpException("Задача с $id не найдена");
        }

        return $this->render('view', ['task' => $task]);
    }

    /**
     * @return string
     */
    public function actionCreate()
    {

        $model = new TaskForm();

        if (Yii::$app->request->getIsPost() && $model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->createTask();
                return $this->goHome();
            }
        }

        return $this->render('create', [
            'model' => $model
        ]);

    }

}