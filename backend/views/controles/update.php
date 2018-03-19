<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Controles */

$this->title = 'Actualizar Controles:';
$this->params['breadcrumbs'][] = ['label' => 'Controles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id_Control, 'url' => ['view', 'id' => $model->Id_Control]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="controles-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
