<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 28.11.2019
 * Time: 8:50
 */

namespace frontend\controllers;

use app\models\Profiles;
use frontend\models\FilterForm;
use frontend\models\Users;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;

class UsersController extends Controller
{

    public function actionIndex()
    {
        $filterFormModel = new FilterForm();
        $filterFormModel->load($_POST);

        $query = Users::find()
            ->joinWith(['userSpecializationCategories' => function($query) {
                $query->leftJoin('categories','`categories`.`id` = `user_specialization_category`.`categories_id`');
            }], true, 'RIGHT JOIN');


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

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5,  'forcePageParam' => false, 'pageSizeParam' => false]);
        $users = $query
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        dump($users);
        return $this->render('users', [
            'users' => $users,
            'pages' => $pages,
            'filterFormModel' => $filterFormModel
        ]);

    }
}