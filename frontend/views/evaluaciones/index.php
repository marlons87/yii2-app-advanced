

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
                                     
                                      
                                       <?php
                                              $graph_data = [];
                                              $graph_data[] = array('Dominio', 'Nivel');

                                              foreach ($dominios as $dom):
                                                  
                                                    foreach ($nivelDominio as $nivel):
                                                  
                                                  if (($dom["Id_Dominio"]==$nivel["Id_Dominio"]) && ($sede['Id_Sede']==$nivel["Id_Sede"]) ){
                                                      
                                                      
                                                      $graph_data[] = array($dom["Codigo"], intval($nivel["Valor"]));
                                                  }
                                                      
                                                  
                                                    endforeach;

                                                  
                                              
                                              
                                              

                                              endforeach;
                                              
                                              
                                               echo GoogleChart::widget(array('visualization' => 'LineChart',
                    'data' => $graph_data,
                    'options' => array('title' => 'Nivel de madurez','width' => 1100,'height' => 400)));
                
                                              
                                              ?>                
                                      
                                      
                                      
                                      
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
                   
                      $graph_data[] = array($gene["Sede"], intval($gene["Valor"]));
                   
               endforeach;
               
                echo GoogleChart::widget(array('visualization' => 'ColumnChart',
                    'data' => $graph_data,
                    'options' => array('title' => 'Nivel de madurez por Sede','width' => 1100,'height' => 400)));
                
                
                
                
                
                 $graficoSede = [];
                
                $array = array('Dominios');
                
                foreach ($ubicaciones as $q):
                    
                    
                     array_push($array, $q['NombreS']);
                    
                endforeach;
                
               
                
                $graficoSede[] = $array;
                $y=1;
                foreach ($dominios as $d):               
                    $x=1;
                    foreach ($ubicaciones as $q):
                        foreach ($nivelDominio as $nivel):
                            if ($d['Id_Dominio']==$nivel['Id_Dominio']&&$q['Id_Sede']==$nivel['Id_Sede']){
                                $graficoSede[$y][0] = $d['Codigo'];
                                $graficoSede[$y][$x] = intval($nivel['Valor']);
                        }

                        endforeach; 
                        $x = $x+1;
                    endforeach;
                   $y = $y+1;
               endforeach;
               var_dump($graficoSede);
               
               
                 echo GoogleChart::widget(array('visualization' => 'LineChart',
                    'data' => $graficoSede,
                    'options' => array('title' => 'Nivel de madurez por Sede','width' => 1100,'height' => 400)));
               
               
               
               
               
               
echo GoogleChart::widget(array('visualization' => 'LineChart',
                'data' => array(
                    array('Task', 'Hours per Day', 'Hola'),
                    array('Work', 11, 2 ),
                    array('Eat', 2, 2),
                    array('Commute', 2, 3),
                    array('Watch TV', 2, 4),
                    array('Sleep', 7, 5)
                ),
                

                'options' => array('title' => 'My Daily Activity',   'tooltip' => array('isHtml'=>'true'))));
    
                                 
               
              
               ?> 
          </div>   
    </div>   
      
  </div>



<p>
    <?= Html::a('Crear evaluación', ['crear'], ['class' => 'btn btn-success']) ?>
</p>
    
   


