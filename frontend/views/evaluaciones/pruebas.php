<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$idEvaluacion = 1;
$this->title = 'Controles a evaluar';

$this->params['breadcrumbs'][] = ['label' => 'Evaluaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<?php foreach ($controles as $valc): ?> 


    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $valc['Nombre']; ?>
            </h3>
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>
            <?php
            $valn = $valc['niveles'];


            foreach ($valc['niveles'] as $varNiveles):
                $val = '';
                foreach ($respuestas as $respuesta):
                    
                    if ($varNiveles['Id_Control'] == $respuesta['Id_Control'] && $varNiveles['Id_Nivel'] == $respuesta['Id_Nivel']) {
                        $val = $varNiveles['Id_Nivel'];
                    }
                endforeach;
                echo Html::radioList($valc['Nombre'] . "radio", $val, [$varNiveles['Id_Nivel'] => $varNiveles['Descripcion']]);

            endforeach;

            ActiveForm::end();
            ?>


        </div>
        
    </div>
<?php endforeach; ?>

