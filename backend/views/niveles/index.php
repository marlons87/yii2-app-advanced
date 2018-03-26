<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Controles;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\NivelesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Niveles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="niveles-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

 

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id_Nivel',
             [
              'attribute' => 'Id_Control',
            'value' => 'control.Nombre',
             'filter' => Html::activeDropDownList($searchModel, 'Id_Control', ArrayHelper::map(Controles::find()->asArray()->all(), 'Id_Control', 'Nombre'),['class'=>'form-control','prompt' => 'Seleccione el control']), 
                 
             ],
            'Valor',
            'Descripcion',
            
               
           

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
       <p>
        <?= Html::a('Agregar Niveles', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>
