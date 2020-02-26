<?php

/* @var $model*/

use frontend\models\Cities;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Регистрация';
?>

<section class="registration__user">
    <h1>Регистрация аккаунта</h1>

    <div class="registration-wrapper">
        <?php

        $form = ActiveForm::begin([
            'options' => ['class' => 'registration__user-form form-create'],
        ]); ?>


        <?php echo $form->field($model, 'email', array(
            'options' => array('class' => ''),
                                                                // как вот тут добавить класс, если возвращается ошибка?
            'labelOptions' => array('for' => 'signupform-email', 'class' => (!$model['email'])? 'input-danger': '' ),
            'errorOptions' => array('tag' => 'span')
        ))
            ->textInput(array('rows' => '1', 'placeholder' => 'kumarm@mail.ru', 'class' => 'input textarea', 'style' => 'width: 100%'), false)
        ?>

        <?php echo $form->field($model, 'username', array(
            'options' => array('class' => ''),
            'labelOptions' => array('for' => 'signupform-username', 'class' => $model['username']),
            'errorOptions' => array('tag' => 'span')
        ))
            ->textInput(array('rows' => '1', 'placeholder' => 'Мамедов Кумар', 'class' => 'input textarea', 'style' => 'width: 100%'), false)

        ?>

        <?php echo $form->field($model, 'city', array(
            'options' => array('class' => ''),
            'labelOptions' => array('for' => 'signupform-city', 'style' => 'display: block; margin-bottom: 0'),
            'errorOptions' => array('tag' => 'span')
        ))
            ->dropDownList(
                Cities::find()->select(['city', 'id'])->indexBy('id')->column(),
                array(
                    'class' => "multiple-select input",
                    'style' => 'width: 100%',
                    'prompt' => array('text' => 'Выбирите город', 'options' => [ 'class' => 'prompt']),
                    'options' => array($model['city'] => ['selected' => true]))
            );?>

        <?php echo $form->field($model, 'password', array(
            'options' => array('class' => ''),
            'labelOptions' => array('for' => 'signupform-password', 'class' => $model['email']),
            'errorOptions' => array('tag' => 'span')
        ))
            ->passwordInput(array( 'class' => 'input textarea', 'style' => 'width: 100%'), false)

        ?>

        <?php echo Html::submitButton('Cоздать аккаунт', ['class' => 'button button__registration', 'name' => 'signup-button']) ?>

        <?php ActiveForm::end() ?>
    </div>
</section>