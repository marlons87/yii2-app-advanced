<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Controles */

$this->title = $model->Id_Control;
$this->params['breadcrumbs'][] = ['label' => 'Controles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="controles-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->Id_Control], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->Id_Control], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Id_Control',
            'Nombre',
            'Id_Dominio',
            'Codigo',
        ],
    ]) ?>

</div>
