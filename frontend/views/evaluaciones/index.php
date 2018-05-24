

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use scotthuangzl\googlechart\GoogleChart;


$this->title = 'Evaluación';

$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Evaluaci&oacute;n</h1>

  <div class="panel-body">
  

      
  <?php
 
 if (sizeof($items)==0){
     ?>
      <p>El usuario no posee evaluaciones</p>
       <?php
 }else{
       ?>
     <ul class="nav nav-pills">
 
  <li class="active"><a data-toggle="pill" href="#menu1">Sedes</a></li>
  <li><a data-toggle="pill" href="#menu2">General</a></li>
</ul>
      
      <div class="tab-content">
          
          <div id="menu1" class="tab-pane fade in active">
                  <?php
                  foreach ($sedes as $sede):
                      ?>
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              <h3 class="panel-title"><b><?php echo $sede['Institucion'] . "  |  " . $sede['sede']; ?></b></h3>
                          </div>

                          <div class="panel-body">

                              <ul class="nav nav-pills">
                                  <li class="active"><a data-toggle="pill" href="<?php echo '#menu1_' . $sede['Id_Sede']; ?>">Ver evaluaciones</a></li>
                                  <li><a data-toggle="pill" href="<?php echo '#menu2_' . $sede['Id_Sede']; ?>">Mostrar comportamiento</a></li>
                              </ul>

                              <div class="tab-content">
                                  <br>
                                  <div id="<?php echo 'menu1_' . $sede['Id_Sede']; ?>" class="tab-pane fade in active">

                                      <?php
                                      foreach ($items as $i):

                                          if ($sede['sede'] == $i["sede"]) {
                                              ?> 

                                              <div class="panel panel-default">
                                                  <div class="panel-heading">
                                                      <h3 class="panel-title">Evaluaci&oacute;n <?php echo $i['Consecutivo'] . "  |  " . $i['descripcion']; ?></h3>
                                                  </div>
                                                  <div class="panel-body">
                                                      <p>Fecha creaci&oacute;n: <?php echo $i['Fecha']; ?></p>
                                                      <p>Persona que la aplic&oacute;: <?php echo $i['usuario'] . " " . $i['Apellido1'] . " " . $i['Apellido2']; ?></p>
                                                      <p>&Uacute;ltima modificaci&oacute;n:<?php echo $i['Fecha_Ultima_Modificacion']; ?></p>
                                                      <?= Html::a('Ver detalles', ['dominios', 'id' => $i['Id_Evaluacion']], ['class' => 'btn btn-primary']) ?>
                                                  </div>
                                              </div>

                                              <?php
                                          }

                                      endforeach;
                                      ?> 

                                  </div>
                                  <div id="<?php echo 'menu2_' . $sede['Id_Sede']; ?>" class="tab-pane fade">
                                      2
                                  </div>
                              </div>





                          </div>






                      </div>
                      <?php
                  endforeach;
              }
              ?> 
          </div> 
          
          <div id="menu2" class="tab-pane fade">
              <h2>Niveles por Sede</h2>
                <?php
              
               $graph_data = [];
               $graph_data[] = array('Sede', 'Nivel');
               
               foreach($general as $gene):
                   
                      $graph_data[] = array($gene["Nombre"], intval($gene["Valor"]));
                   
               endforeach;
               
                echo GoogleChart::widget(array('visualization' => 'ColumnChart',
                    'data' => $graph_data,
                    'options' => array('title' => 'Nivel de madurez por Sede','width' => 1100,'height' => 400)));
                
                
                
                
                
                echo GoogleChart::widget(array('visualization' => 'ColumnChart',
                'data' => array(
                    array('Task', 'Hours per Day', 'Hola'),
                    array('Work', 11, '<b>h</b>'.' mundo '.'h' ),
                    array('Eat', 2, 'Hola'),
                    array('Commute', 2, 'Hola'),
                    array('Watch TV', 2, 'ff'),
                    array('Sleep', 7, 'Hola')
                ),
                
'scriptAfterArrayToDataTable' => "data.setColumnProperty(2, 'role', 'tooltip'); data.setColumnProperty(2, 'html', 'true');" ,
                'options' => array('title' => 'My Daily Activity',  'legend'=> 'none', 'tooltip' => array('isHtml'=>'true'))));
    
                                 
               
              
               ?> 
          </div>   
    </div>   
      
  </div>



<p>
    <?= Html::a('Crear evaluación', ['crear'], ['class' => 'btn btn-success']) ?>
</p>
    
   


