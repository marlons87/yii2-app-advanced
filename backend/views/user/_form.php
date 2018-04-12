<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'Nombre') ->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'Apellido1') ->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'Apellido2') ->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>
    
    <?= $form->field($model, 'passCompare')->passwordInput() ?>

    <?= $form->field($model, 'Id_Rol')->dropDownList($model->RolList, ['prompt' => 'Seleccione...']) ?>

    <?= $form->field($model, 'Id_Institucion')->dropDownList($model->InstitucionList , ['prompt' => 'Seleccione...']) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
