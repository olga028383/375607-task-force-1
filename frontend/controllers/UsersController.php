<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 28.11.2019
 * Time: 8:50
 */

namespace frontend\controllers;

use frontend\models\FilterForm;
use frontend\models\Reviews;
use frontend\models\Users;
use HtmlAcademy\Models\TaskForce;
use yii\data\Pagination;
use yii\data\Sort;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class UsersController extends Controller
{

    public function actionIndex()
    {

        $filterFormModel = new FilterForm();
        $filterFormModel->load($_GET);

        $query = Users::find()
            ->joinWith('userSpecializationCategories', true, 'RIGHT JOIN')
            ->groupBy('users.id')
            ->joinWith('profile')
            ->joinWith('tasks');

        $sort = new Sort([
            'attributes' => [
                'rating' => [
                    'asc' => ['profiles.rating' => SORT_ASC],
                    'desc' => ['profiles.rating' => SORT_DESC],
                    'label' => 'Рейтингу',
                    'class' => 'link-regular'
                ],
                'order_count' => [
                    'asc' => ['profiles.order_count' => SORT_ASC],
                    'desc' => ['profiles.order_count' => SORT_DESC],
                    'label' => 'Числу заказов',
                    'class' => 'link-regular'
                ],
                'view_count' => [
                    'asc' => ['profiles.view_count' => SORT_ASC],
                    'desc' => ['profiles.view_count' => SORT_DESC],
                    'label' => 'Популярности',
                    'class' => 'link-regular'
                ],
                'registered' => [
                    'asc' => ['registered' => SORT_ASC],
                    'desc' => ['registered' => SORT_DESC],
                    'label' => 'Дата регистрации',
                    'class' => 'link-regular'
                ],
            ],
            'defaultOrder' => [
                'registered' => SORT_DESC
            ]
        ]);


        foreach ($filterFormModel as $key => $data) {

            if ($data && $key === 'search') {

                $query->andWhere(['LIKE', 'users.name', $data]);
                $filterFormModel = new FilterForm();
                $filterFormModel->search = $data;

            } else if ($data) {

                switch ($key) {
                    case 'categories':
                        $query->andWhere(['user_specialization_category.categories_id' => $data]);
                        break;
                    case 'free':
                        $query->andWhere([
                            'or',
                            ['tasks.status' => TaskForce::STATUS_COMPLETED],
                            ['tasks.executor_id' => NULL]
                        ]);
                        break;
                    case 'online':
                        $query->andWhere(['>', 'profiles.last_active_at', $filterFormModel->getStartDateOfPeriod('30 minutes')]);
                        break;
                    case 'withReviews':
                        $query->andWhere('users.id = reviews.recipient_id');
                        break;
                }
            }


        }

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $users = $query
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy($sort->orders)
            ->all();


        return $this->render('users', [
            'users' => $users,
            'pages' => $pages,
            'filterFormModel' => $filterFormModel,
            'sort' => $sort
        ]);

    }
    //Здесь вопрос по изображениям, нужно ли создавать миниатюры фото, выполненных работ, на данном этапе
    // или мы это будем делать при загрузке изображений
    public function actionView($id)
    {
        $user = Users::find()
            ->joinWith('userSpecializationCategories', true, 'RIGHT JOIN')
            ->groupBy('users.id')
            ->where(['users.id' => $id])
            ->with('photos', 'tasks')
            ->one();

        if (!$user) {
            throw new NotFoundHttpException("Пользователь $id не найден");
        }

        return $this->render('view', ['user' => $user,]
        );
    }
}