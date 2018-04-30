<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$idEvaluacion = $idevaluacion;
$comentario = "";
$nombre = $nombre;

$this->title = 'Controles a evaluar';
$comentario='';

$this->params['breadcrumbs'][] = ['label' => 'Evaluaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?> para el dominio <?= Html::encode($nombre) ?></h1>

<input id="idEvaluacion" type="hidden" value="<?= Html::encode($idevaluacion) ?>">
<input id="idDominio" type="hidden" value="<?= Html::encode($iddominio) ?>" >

<?php
$form = ActiveForm::begin([
            "method" => "post",
        ]);
?>
<?php foreach ($controles as $valc): ?> 

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $valc['Nombre']; ?>
            </h3>
        </div>
        <div class="panel-body">

            <?php
            $valn = $valc['niveles'];
            $val = '';
            foreach ($valc['niveles'] as $varNiveles):

                foreach ($respuestas as $respuesta):

                    if ($varNiveles['Id_Control'] == $respuesta['Id_Control'] && $varNiveles['Id_Nivel'] == $respuesta['Id_Nivel']) {
                        $val = $varNiveles['Id_Nivel'];
                        $comentario = $respuesta['Observaciones'];
                        break;
                    }
                endforeach;
                if ($varNiveles['Valor'] == -1 && $val == '') {
                            $val = $varNiveles['Id_Nivel'];
                        }
                echo Html::radioList($valc['Nombre'] . "radio", $val, [$varNiveles['Id_Nivel'] => $varNiveles['Descripcion']], ['disabled' => true]);

            endforeach;
            ?>

        </div>
        <div class="panel-footer">
            <label>Observaciones:</label>
            <textarea disabled class="txtObservaciones" id="<?= Html::encode($valc['Id_Control']) ?>"  name="txtObservaciones" style="width:100%"><?= (trim($comentario)); ?></textarea>

        </div>

    </div>
<?php endforeach; ?>

<?=

Html::a('Regresar', ['dominios', 'id' => $idEvaluacion], ['class' => 'btn btn-primary']);


ActiveForm::end();
?>


    

