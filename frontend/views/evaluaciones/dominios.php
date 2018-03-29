<div class="list-group">
  <a href="#" class="list-group-item active">
    Dominios a evaluar:
  </a>
    
<?php

use yii\helpers\Html;
use yii\grid\GridView;

$idEvaluacion = 1;
foreach ($items as $i):?> 

  <a href="#" class="list-group-item"><?php echo $i['Nombre'] ; ?></a>
  <?= Html::a ('Actualizar', ['controles', 'idEvaluacion' => $idEvaluacion, 'idDominio'=>$i['Id_Dominio']], ['class' => 'btn btn-primary']) ?>

     <?php endforeach;?>
</div>


    