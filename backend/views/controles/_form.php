<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Dominios;

/* @var $this yii\web\View */
/* @var $model backend\models\Controles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="controles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Nombre')->textInput(['maxlength' => true]) ?>




 <?= $form->field($model, 'Id_Dominio')->dropDownList(ArrayHelper::map(Dominios::find()->all(), 'Id_Dominio', 'Nombre'),['class' => 'form-control inline-block']); ?>


    <?= $form->field($model, 'Codigo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
