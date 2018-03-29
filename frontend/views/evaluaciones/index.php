<?php

use yii\helpers\Html;


$this->title = 'Evaluación';

$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Evaluaci&oacute;n</h1>

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
          <h3 class="panel-title">Evaluaci&oacute;n <?php echo $i['Consecutivo']." - ".$i['institucion']; ?></h3>
      </div>
      <div class="panel-body">
         
          <p>Fecha creaci&oacute;n: <?php echo $i['Fecha']; ?></p>
          <p>Persona que la aplic&oacute;: <?php echo $i['usuario']." ".$i['Apellido1']." ".$i['Apellido2']; ?></p>
    <?php if ($i['estado']) {
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
        <?= Html::a('Crear evaluacion', ['dominios'], ['class' => 'btn btn-success']) ?>
    </p>
