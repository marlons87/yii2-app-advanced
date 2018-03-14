<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Instituciones */

$this->title = 'Create Instituciones';
$this->params['breadcrumbs'][] = ['label' => 'Instituciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="instituciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
