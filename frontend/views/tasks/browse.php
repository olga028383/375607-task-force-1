<?php

/* @var $this yii\web\View */

/* @var $tasks array */

/* @var $filterFormModel */

use frontend\models\Categories;
use morphos\Russian;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Новые задания';
$this->params['breadcrumbs'][] = $this->title;

?>

<main class="page-main">
    <div class="main-container page-container">
        <section class="new-task">
            <div class="new-task__wrapper">
                <h1><?= Html::encode($this->title) ?></h1>
                <?php
                foreach ($tasks as $task):?>
                    <div class="new-task__card">
                        <div class="new-task__title">
                            <a href="#" class="link-regular"><h2><?= Html::encode($task->name) ?></h2></a>
                            <a class="new-task__type link-regular" href="#">
                                <p><?= Html::encode($task->category->name) ?></p></a>
                        </div>
                        <div class="new-task__icon new-task__icon--<?= Html::encode($task->category->icon) ?>"></div>
                        <p class="new-task_description">
                            <?= $task->description ?>
                        </p>
                        <b class="new-task__price new-task__price--translation"><?= Html::encode($task->sum) ?><b> ₽</b></b>
                        <p class="new-task__place">
                            <?php
                            if ($task->city) {
                                $task->city->name;
                            }
                            echo $task->district;
                            ?>
                        </p>
                        <span class="new-task__time">
                        <?php

                        if ($task->getYear()) {
                            echo Russian\pluralize($task->getYear(), 'год') . ' ';
                        }

                        if ($task->getMonth()) {
                            echo Russian\pluralize($task->getMonth(), 'месяц') . ' ';
                        }
                        if ($task->getDay()) {
                            echo Russian\pluralize($task->getDay(), 'день') . ' ';
                        }

                        if ($task->getHour()) {
                            echo Russian\pluralize($task->getHour(), 'час') . ' ';
                        }

                        ?> назад
                        </span>
                    </div>
                    <?php
                endforeach;
                ?>
            </div>

            <div class="new-task__pagination">
                <ul class="new-task__pagination-list">
                    <li class="pagination__item"><a href="#"></a></li>
                    <li class="pagination__item pagination__item--current">
                        <a>1</a></li>
                    <li class="pagination__item"><a href="#">2</a></li>
                    <li class="pagination__item"><a href="#">3</a></li>
                    <li class="pagination__item"><a href="#"></a></li>
                </ul>
            </div>
        </section>
        <section class="search-task">
            <div class="search-task__wrapper">

                <?php
                $form = ActiveForm::begin([
                    'id' => 'filter-form',
                    'options' => ['class' => 'search-task__form'],
                ]);

                ?>
                <fieldset class="search-task__categories">
                    <legend><?php echo $filterFormModel->getAttributeLabel('categories'); ?></legend>

                    <?php
                        //echo Html::activeCheckboxList($filterFormModel,'categories[]', Categories::find()->select(['name', 'id'])->indexBy('id')->column())
                    ?>

                    <?php echo $form->field($filterFormModel, 'categories[]')
                        ->checkboxList(Categories::find()->select(['name', 'id'])->indexBy('id')->column()) ?>

                    <!--                        <input class="visually-hidden checkbox__input" id="1" type="checkbox" name="" value="" checked>-->
                    <!--                        <label for="1">Курьерские услуги </label>-->

                </fieldset>

                <fieldset class="search-task__categories">
                    <legend>Дополнительно</legend>

                    <?php echo Html::activeInput('checkbox', $filterFormModel, 'withoutExecutor', array('class' => 'visually-hidden checkbox__input', 'id' => 6)); ?>
                    <label for="6">Без исполнителя </label>

                    <?php echo Html::activeInput('checkbox', $filterFormModel, 'distantWork', array('class' => 'visually-hidden checkbox__input', 'id' => 7)); ?>
                    <label for="7">Удаленная работа </label>

                </fieldset>

                <label class="search-task__name" for="8">Период</label>


                <?php
                //Как сюда добавить selected для week
                echo Html::activeDropDownList($filterFormModel, 'time[]',
                    array('day' => 'За день',
                        'week' => 'За неделю',
                        'month' => 'За месяц'),
                    array('class' => 'multiple-select input', 'size' => 1)); ?>


                <label class="search-task__name" for="9">Поиск по названию</label>

                <?php echo Html::activeTextInput($filterFormModel, 'search', array('class' => 'input-middle input')) ?>

                <?= Html::submitButton('Искать', ['class' => 'button']) ?>

                <?php ActiveForm::end() ?>
            </div>
        </section>
    </div>
</main>

