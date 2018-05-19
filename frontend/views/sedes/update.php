<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Sedes */

$this->title = 'Update Sedes: ' . $model->Id_Sede;
$this->params['breadcrumbs'][] = ['label' => 'Sedes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id_Sede, 'url' => ['view', 'id' => $model->Id_Sede]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sedes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
