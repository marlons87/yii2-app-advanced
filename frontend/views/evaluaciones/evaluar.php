<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Dominios evaluar';

$this->params['breadcrumbs'][] = ['label' => 'Evaluaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

 $idEvaluacion = $evaluacion["evaluacion"]; 
 
 

?>
 <h1><?= Html::encode($this->title) ?></h1>
 
 
 <?php
 foreach ($items as $i):?> 
 
  <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><?php echo $i['Nombre'];?></h3>
  </div>
  <div class="panel-body">
    <button type="button" class="btn btn-primary">Evaluar</button>
  </div>
</div>

     
     
 <?php     
 endforeach;

 
