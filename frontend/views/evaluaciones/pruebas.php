<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

$idEvaluacion = 1;
$this->title = 'Controles a evaluar';

$this->params['breadcrumbs'][] = ['label' => 'Evaluaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<?php foreach ($controles as $valc): ?> 


    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $valc['Nombre']; ?></h3>
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>
            <?php
            $valn = $valc['niveles'];
            
                $form->field ($valn, 'Descripcion')
                        ->radioList ($valn ,array('class' => 'i-checks'));
                //$form->field($model, 'bird_mutation')
                //->checkboxList(ArrayHelper::map(BirdSpecieMutation::find()
                //->where(['bird_specie_id' => $model->bird_specie_id])->all(),
                //'id','birdMutation.name','birdMutation.birdMutationType.label'),['prompt' => 'Select Mutations','itemOptions' => ['class' => 'i-checks']]) ?>

               

    <?php ActiveForm::end(); ?>


        </div>
    </div>
<?php endforeach; ?>

