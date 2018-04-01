<?php

use yii\helpers\Html;

$this->title = 'Dominios a evaluar';

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
    
}*/

$idEvaluacion = $id[0];

$notaGlobal=6;
foreach ($items as $i):?> 
 
 
 <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><?php echo $i['Nombre'];?></h3>
  </div>
  <div class="panel-body">
      
  <?php
  
$nivelDominio=6;

     foreach ($calificacion as $cali):
         
        if ($i['Id_Dominio']==$cali["Id_Dominio"]){
               ?>
      
      <p> Control :<?php echo $cali["Codigo"]." ".$cali["Nombre"]." Nivel: ".$cali["Valor"] ?></p>
      
        <?php
        
        if ($nivelDominio>$cali["Valor"]){
            
             $nivelDominio=$cali["Valor"];
        }
    
            
        }
         
     endforeach;
       
       
   
      ?>
      
      <div class="alert alert-info">
          <?php
          
          if ($nivelDominio ==6){
              ?>
             <p>Calificaci&oacute;n: <b> Pendiente </b></p>
                     
                         <?php
          }else
          {
              
               if ($notaGlobal>$nivelDominio){
            
             $notaGlobal= $nivelDominio ;  
        }
              
              
         
              
              
               ?>
            <p>Calificaci&oacute;n: <b><?php echo $nivelDominio ?>  </b></p> 
             <?php
          }
           ?>
            
</div>    
  </div>
</div>
 
     <?php endforeach;?>

  <div class="alert alert-info">
     <p>La calificaci&oacute;n general es: <?php echo $notaGlobal; ?></p>
 </div>



    
