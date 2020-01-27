<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 28.11.2019
 * Time: 8:50
 */

namespace frontend\controllers;

use frontend\models\FilterForm;
use frontend\models\Users;
use yii\data\Pagination;
use yii\data\Sort;
use yii\web\Controller;

class UsersController extends Controller
{

    public function actionIndex()
    {

        //1.Не могу понять как показать только тех пользователей, у которых заполнена хотя бы 1 категория, ниже закомментировано рабочее решение, но оно мне не нравится, как-то сложно
        //2. Сортировка по связаным полям, не могу понять как настроить, на данный момент ошибка

        $filterFormModel = new FilterForm();
        $filterFormModel->load($_POST);

        $query = Users::find()
            ->with('categories', 'profile', 'tasks');
            //->joinWith(['userSpecializationCategories' => function($query) {
               // $query->leftJoin('categories','categories.id = user_specialization_category.categories_id');
            //}], true, 'RIGHT JOIN');

        $sort = new Sort([
            'attributes' => [
                'rating' => [
                    'label' => 'Рейтингу',
                    'class' => 'link-regular'
                ],
                'order_count' => [
                    'label' => 'Числу заказов',
                    'class' => 'link-regular'
                ],
                'view_count' => [
                    'label' => 'Популярности',
                    'class' => 'link-regular'
                ],
            ],
            'defaultOrder' =>[
                'profile.rating' =>[
                    'asc' => 'profile.rating ASC',
                ]
            ]
        ]);

        foreach ($filterFormModel as $key => $data) {
            if ($data) {

                switch ($key) {
                    case 'categories':
                        $query->andWhere(['category_id' => $data]);
                        break;

                        break;
                    case 'search':
                        $query->andWhere(['LIKE', 'name', $data]);
                        break;

                }
            }

        }

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5,  'forcePageParam' => false, 'pageSizeParam' => false]);
        $users = $query
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy($sort->orders)
            ->all();

       //dump($users);
        return $this->render('users', [
            'users' => $users,
            'pages' => $pages,
            'filterFormModel' => $filterFormModel,
            'sort'=> $sort
        ]);

    }
}