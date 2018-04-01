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



$idEvaluacion = 1;
foreach ($items as $i):?> 
 
 
 <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><?php echo $i['Nombre'];?></h3>
  </div>
  <div class="panel-body">
      
      
   
      
      
        <?= Html::a ($i['Nombre'] , ['pruebas', 'idEvaluacion' => $idEvaluacion, 'idDominio'=>$i['Id_Dominio']], ['class' => 'list-group-item']) ?>
  </div>
</div>

  


     <?php endforeach;?>



    