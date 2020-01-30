<?php
/* @var $filterFormModel */
/* @var $users */
/* @var $pages */
/* @var $sort */

use frontend\models\Categories;
use morphos\Russian;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

$this->title = 'Исполнители';
$this->params['breadcrumbs'][] = $this->title;
$stars = 5;
?>
<main class="page-main">
    <div class="main-container page-container">
        <section class="user__search">
            <div class="user__search-link">
                <p>Сортировать по:</p>
                <ul class="user__search-list">

                    <li class="user__search-item user__search-item--current">
                        <?php echo $sort->link('rating', ['class' => 'link-regular']);?>
                    </li>
                    <li class="user__search-item">
                        <?php echo $sort->link('view_count', ['class' => 'link-regular']);?>
                    </li>
                    <li class="user__search-item">
                       <?php echo $sort->link('order_count', ['class' => 'link-regular']) ;?>
                    </li>
                </ul>
            </div>
            <?php foreach($users as $user):?>
                <div class="content-view__feedback-card user__search-wrapper">
                    <div class="feedback-card__top">
                        <div class="user__search-icon">
                            <a href="#">
                                <?php if($user->profile->avatar):?>
                                    <img src="/img/man-glasses.jpg" width="65" height="65">
                                <?php else:?>
                                    <img src="/img/empty.webp" width="65" height="65">
                                <?php endif?>
                            </a>
                            <span><?php echo count($user->tasks)?></span>
                            <span>
                               <?php
                                    echo Russian\pluralize(count($user->reviews), 'отзыв');
                                ?>
                            </span>
                        </div>
                        <div class="feedback-card__top--name user__search-card">
                            <p class="link-name"><a href="#" class="link-regular"><?php echo $user->name ?></a>
                            </p>

                            <?php

                            for($i = 0; $i < $stars; $i++):?>
                                <?php if(round($user->profile->rating) > $i):?>
                                    <span></span>
                                <?php else:?>
                                    <span class="star-disabled"></span>
                                <?php endif?>
                            <?php endfor?>
                            <b><?php echo floatval($user->profile->rating)?></b>
                            <p class="user__search-content">
                                <?php echo $user->profile->biography ?>
                            </p>
                        </div>
                        <span class="new-task__time">Был на сайте
                            <?php

                           if ($user->getYear($user->profile->last_active_at)) {
                              echo Russian\pluralize($user->getYear($user->profile->last_active_at), 'год') . ' ';
                           }

                            if ($user->getMonth($user->profile->last_active_at)) {
                                echo Russian\pluralize($user->getMonth($user->profile->last_active_at), 'месяц') . ' ';
                           }
                            if ($user->getDay($user->profile->last_active_at)) {
                                echo Russian\pluralize($user->getDay($user->profile->last_active_at), 'день') . ' ';
                            }

                            if ($user->getHour($user->profile->last_active_at)) {
                                echo Russian\pluralize($user->getHour($user->profile->last_active_at), 'час') . ' ';
                            }
                            if ($user->getMinutes($user->profile->last_active_at)) {
                                echo Russian\pluralize($user->getMinutes($user->profile->last_active_at), 'минута') . ' ';
                            }
                            if ($user->getSecond($user->profile->last_active_at)) {
                                echo Russian\pluralize($user->getSecond($user->profile->last_active_at), 'секунда') . ' ';
                            }
                            ?>

                            назад</span>
                    </div>
                    <div class="link-specialization user__search-link--bottom">
                        <?php foreach($user->categories as $category):?>
                            <a href="#" class="link-regular"><?php echo $category->name?></a>
                        <?php endforeach ?>
                    </div>
                </div>
            <?php endforeach ?>
            <div class="new-task__pagination">

                <?php echo LinkPager::widget([
                    'pagination' => $pages,
                    'options' => ['class'=>"new-task__pagination-list"],
                    'pageCssClass' => 'pagination__item',
                    'activePageCssClass' => 'pagination__item--current',
                    'prevPageCssClass' => 'pagination__item',
                    'nextPageCssClass' => 'pagination__item',
                    'prevPageLabel' => '',
                    'nextPageLabel' => ''
                ]);
                ?>
            </div>
        </section>

        <section  class="search-task">
            <div class="search-task__wrapper">
                <?php $form = ActiveForm::begin([
                    'id' => 'filter-form',
                    'options' => ['class' => 'search-task__form'],
                    ]);
                ?>
                    <fieldset class="search-task__categories">
                        <legend>Категории</legend>
                        <?php echo $form->field($filterFormModel, 'categories[]', array('options' => array('class' => '')))
                            ->checkboxList(Categories::find()->select(['name', 'id'])->indexBy('id')->column(), array('item' => function ($index, $label, $name, $checked, $value) use ($filterFormModel) {
                                $activeCheckbox = '';

                                if (!empty($filterFormModel['categories']) && in_array($value, $filterFormModel['categories'])) {
                                    $activeCheckbox = 'checked';
                                }
                                return '<input class="visually-hidden checkbox__input" id="categories_' . $value . '" type="checkbox" name="' . $name . '" value="' . $value . '"' . $activeCheckbox . '>
                                        <label for="categories_' . $value . '">' . $label . '</label>';
                            }))->label(false);
                        ?>

                    </fieldset>
                    <fieldset class="search-task__categories">
                        <legend>Дополнительно</legend>

                        <?php echo $form->field($filterFormModel, 'free', array(
                            'template' => '{input}{label}',
                            'options' => array('class' => ''),
                            'labelOptions' => array('style' => 'display: block; margin-bottom: 0')
                        ))
                            ->checkbox(array('class' => 'visually-hidden checkbox__input'), false);
                        ?>

                        <?php echo $form->field($filterFormModel, 'online', array(
                            'template' => '{input}{label}',
                            'options' => array('class' => ''),
                            'labelOptions' => array('style' => 'display: block; margin-bottom: 0')
                        ))
                            ->checkbox(array('class' => 'visually-hidden checkbox__input'), false);
                        ?>

                        <?php echo $form->field($filterFormModel, 'withReviews', array(
                            'template' => '{input}{label}',
                            'options' => array('class' => ''),
                            'labelOptions' => array('style' => 'display: block; margin-bottom: 0')
                        ))
                            ->checkbox(array('class' => 'visually-hidden checkbox__input'), false);
                        ?>
                    </fieldset>

                <?php echo $form->field($filterFormModel, 'search', array(
                'template' => '{label}{input}',
                'options' => array('class' => ''),
                'labelOptions' => array('class' => 'search-task__name', 'style' => 'display: block; margin-bottom: 0')
                ))
                ->input('text', array('class' => 'input-middle input', 'style' => 'width: 100%')); ?>

                <?= Html::submitButton('Искать', ['class' => 'button']) ?>
                <?php ActiveForm::end() ?>
            </div>
        </section>
    </div>
</main>