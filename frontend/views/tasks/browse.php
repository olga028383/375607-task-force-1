<?php

/* @var $this yii\web\View */

/* @var $tasks array */

/* @var $filterFormModel */

use frontend\models\Categories;
use morphos\Russian;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$request = Yii::$app->request;
$get = $request->get();

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
                                $task->city->city;
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
                    <?php echo $form->field($filterFormModel, 'myCity', array(
                        'template' => '{input}{label}',
                        'options' => array('class' => ''),
                        'labelOptions' => array('style' => 'display: block; margin-bottom: 0')
                    ))
                        ->checkbox(array('class' => 'visually-hidden checkbox__input'), false);

                    echo $form->field($filterFormModel, 'distantWork', array(
                        'template' => '{input}{label}',
                        'options' => array('class' => ''),
                        'labelOptions' => array('style' => 'display: block; margin-bottom: 0')
                    ))
                        ->checkbox(array('class' => 'visually-hidden checkbox__input'), false); ?>

                </fieldset>


                <?php echo $form->field($filterFormModel, 'time', array(
                    'template' => '{label}{input}',
                    'options' => array('class' => ''),
                    'labelOptions' => array('class' => 'search-task__name', 'style' => 'display: block; margin-bottom: 0')
                ))
                    ->dropDownList(
                        $filterFormModel->availableTime,
                        array(
                            'class' => "multiple-select input",
                            'style' => 'width: 100%',
                            'prompt' => array('text' => 'За все время', 'options' => ['value' => '0', 'class' => 'prompt']),
                            'options' => array($filterFormModel['time'] => ['selected' => true]))
                    );

                echo $form->field($filterFormModel, 'search', array(
                    'template' => '{label}{input}',
                    'options' => array('class' => ''),
                    'labelOptions' => array('class' => 'search-task__name', 'style' => 'display: block; margin-bottom: 0')
                ))
                    ->input('text', array('class' => 'input-middle input', 'style' => 'width: 100%'));

                ?>

                <?= Html::submitButton('Искать', ['class' => 'button']) ?>

                <?php ActiveForm::end() ?>
            </div>
        </section>
    </div>
</main>

