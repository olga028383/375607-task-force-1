<?php

/* @var $model */

/* @var $errors */

use frontend\models\Categories;
use yii\web\View;
use yii\widgets\ActiveForm;
$user = Yii::$app->user->getIdentity();
?>
    <section class="create__task">
        <h1>Публикация нового задания</h1>
            <div class="create__task-main">

                <?php $form = ActiveForm::begin([
                    'options' => ['class' => 'create__task-form form-create', 'action' =>'/create', 'enctype' => 'multipart/form-data', 'id'=>'task-form'],
                ]); ?>

                <?php $form->field($model, 'customer_id')->hiddenInput(array('value' => $user->getId())) ?>

                <?php echo $form->field($model, 'name', array(
                    'options' => array('class' => 'field-group field-group--first'),
                    'labelOptions' => array('for' => 'name'),
                    'errorOptions' => array('tag' => 'span')
                ))
                    ->textarea(array('rows' => '1', 'id'=>'name', 'placeholder' => 'Повесить полку', 'class' => 'input textarea', 'style' => 'width: 100%'), false)
                ?>

                <span>Кратко опишите суть работы</span>

                <?php echo $form->field($model, 'description', array(
                    'options' => array('class' => 'field-group'),
                    'labelOptions' => array('for' => 'description'),
                    'errorOptions' => array('tag' => 'span')
                ))
                    ->textarea(array('rows' => '7', 'id'=>'description', 'placeholder' => 'Place your text', 'class' => 'input textarea', 'style' => 'width: 100%'), false)
                ?>

                <span>Укажите все пожелания и детали, чтобы исполнителям было проще соориентироваться</span>

                <?php echo $form->field($model, 'category', array(
                    'options' => array('class' => 'field-group'),
                    'labelOptions' => array('for' => 'category'),
                    'errorOptions' => array('tag' => 'span')
                ))
                ->dropDownList(
                    Categories::find()->select(['name', 'id'])->indexBy('id')->column(),
                    array(
                        'id' => 'category',
                        'class' => "multiple-select input multiple-select-big",
                        'style' => 'width: 100%',
                        'prompt' => array('text' => 'Выбирите категорию', 'options' => [ 'class' => 'prompt']),
                        'options' => array($model['category'] => ['selected' => true]))
                );?>

                <span>Выберите категорию</span>
                <label>Файлы</label>
                <span>Загрузите файлы, которые помогут исполнителю лучше выполнить или оценить работу</span>

                <div class="create__file">
                    <span>Добавить новый файл</span>
                    <!--                          <input type="file" name="TaskForm[files]" class="dropzone">-->
                </div>

                <label for="13">Локация</label>
                <input class="input-navigation input-middle input" id="13" type="search" name="q"
                       placeholder="Санкт-Петербург, Калининский район">
                <span>Укажите адрес исполнения, если задание требует присутствия</span>
                <div class="create__price-time">
                    <div class="create__price-time--wrapper">

                        <?php echo $form->field($model, 'sum', array(
                            'options' => array('class' => 'field-group'),
                            'labelOptions' => array('for' => 'sum'),
                            'errorOptions' => array('tag' => 'span')
                        ))
                            ->textarea(array('rows' => '1', 'id'=>'sum', 'placeholder' => '1000', 'class' => 'input textarea input-money', 'style' => 'width:100%; box-sizing: border-box'), false)
                        ?>

                        <span>Не заполняйте для оценки исполнителем</span>
                    </div>
                    <div class="create__price-time--wrapper">

                        <?php echo $form->field($model, 'deadline', array(
                            'options' => array('class' => 'field-group'),
                            'labelOptions' => array('for' => 'deadline'),
                            'errorOptions' => array('tag' => 'span')
                        ))
                            ->textInput(array('type' => 'date', 'rows' => '1', 'id'=>'deadline', 'placeholder' => '10.11, 15:00', 'class' => 'input-middle input input-date', 'style' => 'width:100%; box-sizing: border-box'), false)
                        ?>

                        <span>Укажите крайний срок исполнения</span>
                    </div>
                </div>
            <?php ActiveForm::end() ?>

            <div class="create__warnings">
                <div class="warning-item warning-item--advice">
                    <h2>Правила хорошего описания</h2>
                    <h3>Подробности</h3>
                    <p>Друзья, не используйте случайный<br>
                        контент – ни наш, ни чей-либо еще. Заполняйте свои
                        макеты, вайрфреймы, мокапы и прототипы реальным
                        содержимым.</p>
                    <h3>Файлы</h3>
                    <p>Если загружаете фотографии объекта, то убедитесь,
                        что всё в фокусе, а фото показывает объект со всех
                        ракурсов.</p>
                </div>

                <?php if(!empty($errors)):?>

                    <div class="warning-item warning-item--error">
                        <h2>Ошибки заполнения формы</h2>

                        <?php foreach($errors as $name=>$error):?>

                            <h3><?php echo $model->getAttributeLabel($name);?></h3>

                            <p><?php echo implode(', ', $error)?></p>
                        <?php endforeach?>
                    </div>
                <?php endif?>
            </div>
        </div>
        <button form="task-form" class="button" type="submit" name="create-button">Опубликовать</button>
    </section>


<?php
$this->registerJsFile(Yii::$app->request->BaseUrl . '/js/dropzone.js');
$this->registerJs(
    "var dropzone = new Dropzone(\"div.create__file\", {
        url: \"/create\",
        paramName: \"file\"
    });
    dropzone.on(\"sending\", function(file, xhr, formData) {
        formData.append('".Yii::$app->request->csrfParam ."',  '".Yii::$app->request->getCsrfToken()."');
    });",
    View::POS_READY,
    'my-button-handler'
);
?>