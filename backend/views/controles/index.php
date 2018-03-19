<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ControlesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Controles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="controles-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Agregar Controles', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id_Control',
             [
              'attribute' => 'Id_Dominio',
            'value' => 'dominio.Nombre',
                 
             ],
            'Codigo',
            'Nombre',
          
           

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
