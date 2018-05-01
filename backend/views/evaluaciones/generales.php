<?php

    use yii\helpers\Html;
  
    use yii\helpers\ArrayHelper;

    $this->title = 'Evaluaciones';
   
    $this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<?php
foreach ($evaluaciones as $i):?> 
    
 <div class="panel panel-default">
  <div class="panel-heading">
      <h3 class="panel-title">
         Evaluaci&oacute;n <?php echo $i['Consecutivo']." - ".$i['institucion']; ?>
      </h3>
  </div>
  <div class="panel-body">
     <p>Fecha creaci&oacute;n: <?php echo $i['Fecha']; ?></p>
          <p>Persona que la aplic&oacute;: <?php echo $i['Nombre']." ".$i['Apellido1']." ".$i['Apellido2']; ?></p>
   
              <p>&Uacute;ltima modificaci&oacute;n:<?php echo $i['Fecha_Ultima_Modificacion'];
              
              ?></p>
               
        <?= Html::a('Ver detalles', ['dominios', 'id' => $i['Id_Evaluacion']], ['class' => 'btn btn-primary']) ?>
  
        <?php
   
    ?>
  </div>
</div>
    
 <?php   
endforeach;
?> 
