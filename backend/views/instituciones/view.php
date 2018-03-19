<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Instituciones */

$this->title = $model->Nombre;
$this->params['breadcrumbs'][] = ['label' => 'Instituciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="instituciones-view">

    <h1><?= Html::encode($this->title) ?></h1>

   

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Id_Institucion',
            'Nombre',
        ],
    ]) ?>
    
     <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->Id_Institucion], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->Id_Institucion], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Está seguro que desea eliminar este registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
