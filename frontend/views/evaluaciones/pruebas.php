<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;


$idEvaluacion = 1;
$this->title = 'Controles a evaluar';

$this->params['breadcrumbs'][] = ['label' => 'Evaluaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<?php foreach ($controles as $valc): ?> 


    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $valc['Nombre']; ?>
            </h3>
        </div>
        <div class="panel-body">
            
            
            
         
            <?php $form = ActiveForm::begin();?>

            <?php
            $valn = $valc['niveles'];


            foreach ($valc['niveles'] as $varNiveles):
                $val = '';
                foreach ($respuestas as $respuesta):
                    
                    if ($varNiveles['Id_Control'] == $respuesta['Id_Control'] && $varNiveles['Id_Nivel'] == $respuesta['Id_Nivel']) {
                        $val = $varNiveles['Id_Nivel'];
                        
                       
                    }
                    
                    
                    

                    
                endforeach;
                 echo $form->field ($varNiveles, 'Id_Nivel')->radioList([$varNiveles['Id_Nivel'] => $varNiveles['Descripcion']]);
                 
                $idNivel=  1;
                
                //echo Html::radioList("radio", $val, [$varNiveles['Id_Nivel'] => $varNiveles['Descripcion'],]);
                
                
                
 
                
               
                
             
                
               

            endforeach;
               
          echo Html::a('Evaluar', ['responder', 'id' => $idEvaluacion,'Id_Dominio'=>$valc['Id_Dominio'],'idNivel'=>$idNivel], ['class' => 'btn btn-primary']); 

            ActiveForm::end();?>
            
          


        </div>
        
    </div>
<?php endforeach; ?>














