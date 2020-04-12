<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 28.11.2019
 * Time: 8:50
 */

namespace frontend\controllers;

use app\models\UploadForm;
use frontend\models\FilterForm;
use frontend\models\Responses;
use frontend\models\TaskForm;
use frontend\models\Tasks;
use HtmlAcademy\Models\TaskForce;
use Yii;
use yii\data\Pagination;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\bootstrap\ActiveForm;

/**
 * Class TasksController
 * @package frontend\controllers
 */
class TasksController extends SecuredController
{

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
        $model->load(Yii::$app->request->post());
        //Возник вот здесь вопрос, как обработать данные файлов, которые загружаются отдельно от формы,

        if (Yii::$app->request->isAjax) {
            $model->files[] = UploadedFile::getInstance($model, 'file');
        }

        if ($model->validate()) {
            dump($model);
                //if($task = $model->createTask()){
                    //var_dump($model);
                    //exit;
                            //$model->addFiles($task);
                       // }
            // все данные корректны
        }

        return $this->render('create', [
            'model' => $model,
            'errors' => $model->errors
        ]);

    }


}