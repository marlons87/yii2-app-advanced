<?php

use yii\helpers\Html;
  $nombre= $nombre;
  
  
 
$this->title = 'Evaluaciones'; 

$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Evaluaci&oacute;n de  <?php echo $nombre;?></h1>


  
       
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

