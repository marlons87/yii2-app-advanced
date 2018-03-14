<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\NivelesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="niveles-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id_Nivel') ?>

    <?= $form->field($model, 'Valor') ?>

    <?= $form->field($model, 'Descripcion') ?>

    <?= $form->field($model, 'Id_Control') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
