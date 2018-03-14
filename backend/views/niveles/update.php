<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Niveles */

$this->title = 'Update Niveles: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Niveles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id_Nivel, 'url' => ['view', 'id' => $model->Id_Nivel]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="niveles-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
