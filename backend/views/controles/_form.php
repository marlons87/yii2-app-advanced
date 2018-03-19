<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Controles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="controles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Id_Dominio')->textInput() ?>
    <?= $form->field($model, 'Codigo')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'Nombre')->textInput(['maxlength' => true]) ?>

  

    

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
