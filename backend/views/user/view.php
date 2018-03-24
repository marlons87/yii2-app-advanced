<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            
            [
               'label' => 'Nombre de Usuario',
               'value' => $model->username,
           ],
             [
               'label' => 'Estado',
               'value' => $model->status,
           ],
            [
               'label' => 'E-mail',
               'value' => $model->email,
           ],
            [
               'label' => 'Fecha creación',
               'value' => $model->created_at,
           ],
            [
               'label' => 'Fecha actualización',
               'value' => $model->updated_at,
           ],             
            
            [
                'label' => 'Rol',
                'value' => $model->roles->Descripcion ,                
            ]
            
        ],
    ]) ?>

</div>
