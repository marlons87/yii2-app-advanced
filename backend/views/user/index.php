<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
 
        'id',
        'username',
        //'auth_key',
        //'password_hash',
        //'password_reset_token',
        'email:email',
        'status',
        //'created_at',
        //'updated_at',
        [
            'attribute' => 'Id_Rol',
            'value' => 'roles.Descripcion',

        ],
 
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
    
     <p>
        <?= Html::a('Agregar Usuario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>
