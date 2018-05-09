<?php

    use yii\helpers\Html;
    use scotthuangzl\googlechart\GoogleChart;
  

    $this->title = 'Dominios evaluados';
    $this->params['breadcrumbs'][] = ['label' => 'Evaluaciones', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<?php
    $idEvaluacion = $id;
    $notaGlobal = 6;
foreach ($items as $i):?> 


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
                    
                    if (intval($cali["Valor"])>=0){
                          $graph_data[] = array($cali["Nombre"], intval($cali["Valor"]));
                    }else{
                        ?>
            
            <p>El control <b><?php echo $cali["Nombre"];  ?></b> fue seleccionado como no aplicable.</p>
                        
                     <?php   
                    }
                    
                  
                    ?>

                    <?php
                    if ($nivelDominio > $cali["Valor"] AND $cali["Valor"]>=0 ) {

                        $nivelDominio = $cali["Valor"];
                    }
                }


            endforeach;


            if ($nivelDominio != 6) {

                echo GoogleChart::widget(array('visualization' => 'ColumnChart',
                    'data' => $graph_data,
                    'options' => array('title' => 'Resultado de la evaluación de los controles del dominio: ' . $i['Nombre'], 'height' => 450)));
            }

            if ($nivelDominio == 6) {
                ?>
                <?= Html::a('Evaluar', ['evaluar', 'idEvaluacion' => $idEvaluacion, 'idDominio' => $i['Id_Dominio']], ['class' => 'btn btn-primary']) ?>
                <?php
            } else {
                ?>

                <?=
                Html::a('Ver detalles', ['evaluar', 'idEvaluacion' => $idEvaluacion, 'idDominio' => $i['Id_Dominio']], ['class' => 'btn btn-primary']);
            }
            ?>

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

    <?php if ($notaGlobal == 6) {
        ?> 

    <p>La calificaci&oacute;n de la evaluaci&oacute;n se encuentra <b>Pendiente</b>.</p>
        <?php
    } else {
        ?>
        <p>La calificaci&oacute;n general es: <b><?php echo $notaGlobal; ?></b></p>
        <?php
    }
    ?>

</div>