<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Dominios evaluar';

$this->params['breadcrumbs'][] = ['label' => 'Evaluaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$idEvaluacion = $evaluacion["evaluacion"]; 



?>
<h1><?= Html::encode($this->title) ?></h1>

<ul class="list-group">
<?php


foreach ($items as $i):?> 

    <li class="list-group-item">
        
         <?= Html::a($i['Nombre'], ['evaluar','idEvaluacion' => $idEvaluacion,'idDominio'=>$i['Id_Dominio'],'nombre'=>$i['Nombre']]) ?>
      
     
  
  
  </li>
  








    
    
<?php


endforeach;
?>
</ul>