<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Controles;

/* @var $this yii\web\View */
/* @var $model backend\models\Niveles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="niveles-form">

    <?php $form = ActiveForm::begin(); ?>
    
    
    <?= $form->field($model, 'Id_Control')->dropDownList(ArrayHelper::map(Controles::find()->all(), 'Id_Control', 'Nombre'),['class' => 'form-control inline-block']); ?>

    <?= $form->field($model, 'Valor')->textInput() ?>

    <?= $form->field($model, 'Descripcion')->textInput(['maxlength' => true]) ?>


   
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
