<?php

use yii\helpers\Html;

$this->title = 'Dominios a evaluar';

$this->params['breadcrumbs'][] = ['label' => 'Evaluaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

   

?>
 <h1><?= Html::encode($this->title) ?></h1>

<div class="list-group">

    
<?php



$idEvaluacion = 1;
foreach ($items as $i):?> 

  <a href="#" class="list-group-item"><?php echo $i['Nombre'] ; ?></a>
  <?= Html::a ('Actualizar', ['controles', 'idEvaluacion' => $idEvaluacion, 'idDominio'=>$i['Id_Dominio']], ['class' => 'btn btn-primary']) ?>

     <?php endforeach;?>
</div>


    