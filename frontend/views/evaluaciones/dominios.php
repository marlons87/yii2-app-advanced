<?php

use yii\helpers\Html;
use scotthuangzl\googlechart\GoogleChart;
use yii\helpers\ArrayHelper;

$this->title = 'Dominios evaluados';

$this->params['breadcrumbs'][] = ['label' => 'Evaluaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>




<?php
/*
  if ($evaluacion["evaluacion"]==null){
  $idEvaluacion = $i['Id_Evaluacion'];
  }else
  {
  $idEvaluacion = $evaluacion["evaluacion"];

  } */






$idEvaluacion = $id;

$notaGlobal = 6;
foreach ($items as $i):
    ?> 


    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $i['Nombre']; ?></h3>
        </div>
        <div class="panel-body">

    <?php
    $nivelDominio = 6;


    $graph_data = [];
    $graph_data[] = array('Nombre', 'Valor');

    foreach ($calificacion as $cali):

        if ($i['Id_Dominio'] == $cali["Id_Dominio"]) {
            ?>

                    <?php
                    $graph_data[] = array($cali["Nombre"], intval($cali["Valor"]));
                    ?>

                    <?php
                    if ($nivelDominio > $cali["Valor"]) {

                        $nivelDominio = $cali["Valor"];
                    }
                }


            endforeach;



            if (sizeof($graph_data) > 6) {
                $tipoGrafico = 'BarChart';
            } else {
                $tipoGrafico = 'ColumnChart';
            }

            if ($nivelDominio != 6) {

                echo GoogleChart::widget(array('visualization' => 'ColumnChart',
                    'data' => $graph_data,
                    'options' => array('title' => 'Resultado de la evaluación de los controles del dominio: ' . $i['Nombre'], 'height' => 450)));
            }
            ?>

            
            
              <?= Html::a('Ver detalles', ['evaluar','idEvaluacion' => $idEvaluacion,'idDominio'=>$i['Id_Dominio']], ['class' => 'btn btn-primary']) ?>
            
            <br> <br>
            <div class="alert alert-info">
            <?php
            if ($nivelDominio == 6) {
                ?>
                    <p>Calificaci&oacute;n: <b> Pendiente </b></p>

                <?php
            } else {

                if ($notaGlobal > $nivelDominio) {

                    $notaGlobal = $nivelDominio;
                }
                ?>


                    <p>Calificaci&oacute;n: <b><?php echo $nivelDominio ?>  </b></p> 


                <?php
            }
            ?>

            </div> 


        </div>
    </div>

            <?php endforeach; ?>

<div class="alert alert-info">
    <p>La calificaci&oacute;n general es: <?php echo $notaGlobal; ?></p>
</div>









