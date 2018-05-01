<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Instituciones;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'Identificacion',
            'username',
            'Nombre',
            'Apellido1',
            'Apellido2',
            'Puesto',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
           // 'email:email',
            //'status',
            //'created_at',
            //'updated_at',
            //'Id_Institucion',
            [
              'attribute' => 'Id_Institucion',
            'value' => 'instituciones.Nombre',
             'filter' => Html::activeDropDownList($searchModel, 'Id_Institucion', ArrayHelper::map(Instituciones::find()->asArray()->all(), 'Id_Institucion', 'Nombre'),['class'=>'form-control','prompt' => 'Seleccione la institución']), 
             ],

            ['class' => 'yii\grid\ActionColumn','header'=>'Acciones'],
        ],
    ]); ?>
    
    <p>
        <?= Html::a('Agregar usuario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>
