<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Instituciones */

$this->title = 'Update Instituciones: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Instituciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id_Institucion, 'url' => ['view', 'id' => $model->Id_Institucion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="instituciones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
