<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'EMC2 | Evaluaciones';
?>
<h1>Modelo de Madurez en Ciberseguridad</h1>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Mis Evaluaciones</h3>
  </div>
  <div class="panel-body">
  
       
  <?php
  
  

 
 if (sizeof($items)==0){
     
      ?>
      
      <p>El usuario no posee evaluaciones</p>
       <?php
 }else{
   
 foreach ($items as $i):
          ?>
          
          <div class="panel panel-default">
      <div class="panel-heading">
          <h3 class="panel-title">Evaluaci&oacute;n <?php echo $i['Consecutivo']; ?></h3>
      </div>
      <div class="panel-body">
          <p>Fecha creaci&oacute;n: <?php echo $i['Fecha']; ?></p>
    <?php if ($i['Status']) {
        ?> 
                     <p>Estado: Completa</p>
        <?php
    } else {
        ?>  
              <p>Estado: Incompleta</p>
              <p>&Uacute;ltima modificaci&oacute;n:<?php echo $i['Fecha_Ultima_Modificacion']; ?></p>
              
        <?= Html::a('Ver detalles', ['update', 'id' => $i['Id_Evaluacion']], ['class' => 'btn btn-primary']) ?>
        <?php
    }
    ?>
          

                </div>
    </div>
        
          
<?php endforeach; 
 }
 
?> 

      
      
  </div>
</div>


 <p>
        <?= Html::a('Crear evaluacion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
