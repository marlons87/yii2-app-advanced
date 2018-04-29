<?php

use yii\helpers\Html;
 use scotthuangzl\googlechart\GoogleChart;
   use yii\helpers\ArrayHelper;
  $nombre= $nombre;
  $cantidad=$cantidad;
 
$this->title = 'Evaluaciones'; 

$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Evaluaci&oacute;n de  <?php echo $nombre;?></h1>
    
<br/><br/>

 <ul class="nav nav-pills">
 
  <li class="active"><a data-toggle="pill" href="#menu1">Ver evaluaciones</a></li>
  <li><a data-toggle="pill" href="#menu2">Mostrar hist&oacute;rico</a></li>
</ul>

<div class="tab-content">
  
  <div id="menu1" class="tab-pane fade in active">
      
      <br/>
       <br/>
      
      
       <?php
  
 if (sizeof($items)==0){
     
      ?>

<div class="alert alert-info">
    <p>La instituci&oacute;n no posee evaluaciones</p>
</div>
      

       <?php
 }else{
   
 foreach ($items as $i):
          ?>
          
          <div class="panel panel-default">
      <div class="panel-heading">
          <h3 class="panel-title">Evaluaci&oacute;n <?php echo $i['Consecutivo']." - ".$i['institucion']; ?></h3>
      </div>
      <div class="panel-body">
          
          <p>Fecha creaci&oacute;n: <?php echo $i['Fecha']; ?></p>
          <p>Persona que la aplic&oacute;: <?php echo $i['usuario']." ".$i['Apellido1']." ".$i['Apellido2']; ?></p>
   
              <p>&Uacute;ltima modificaci&oacute;n:<?php echo $i['Fecha_Ultima_Modificacion'];
              
              ?></p>
               
        <?= Html::a('Ver detalles', ['dominios', 'id' => $i['Id_Evaluacion']], ['class' => 'btn btn-primary']) ?>
  
        <?php
   
    ?>
          

                </div>
    </div>
        
          
<?php endforeach; 
 }
 
?> 

  </div>
  <div id="menu2" class="tab-pane fade">
      
 <h2>Comportamiento por instituci&oacute;n</h2>
     <?php
     
     
     if (sizeof($historico)>0){
         
         $graph_data = [];
                $graph_data[] = array('Nombre', 'Nivel de madurez');
                

               foreach ($historico as $t):

                    $graph_data[] = array($t["Fecha"], intval($t["Valor"])); 
               endforeach;  
                 
                 
                 
      echo GoogleChart::widget(array('visualization' => 'LineChart',
                 'data' => $graph_data,
               
                'options' => array('title' => 'Desempeño de la organización en las evaluaciones: ', 'width' => 1200,'height' => 500)));
         
     }else{
         
           ?>  
         <div class="alert alert-warning">
             <p>La instituci&oacute;n no posee evaluaciones, por lo que no se puede mostrar un comportamiento.</p>
</div>
         <?php
         
         }
     

                 
                
      
      
      ?>  
      
     
             <div class="alert alert-info">
                 
                 <p>Cantidad de evaluaciones: <b> <?php
                 
                 echo intval($cantidad['cantidad']);
                 ?></b></p>
                 
                
                 
              
             
             
             </div>
    
      
      
  </div>
</div>  



      

</div>






