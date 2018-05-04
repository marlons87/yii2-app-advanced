<?php
use yii\helpers\Html;
use scotthuangzl\googlechart\GoogleChart;
use yii\widgets\ActiveForm;
use common\models\Instituciones;
use common\models\InstitucionesSearch;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */

$this->title = 'ECM2';

 $cantidad=$cantidad;
 


?>
<div class="site-index">
    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Nivel por Instituci&oacute;n</h2>
                   <ul class="list-group">
                <?php
                 foreach ($notaXInstitucion as $nota):
                     ?>
                   <li class="list-group-item">
                    <span class="badge"><?php echo $nota['Valor']; ?></span>
                
                    
                             <?= Html::a($nota['Nombre'], ['evaluaciones/index','Id_Institucion' => $nota['Id_Institucion'],'nombre'=>$nota['Nombre']]) ?>
                    
                  </li>
                   <?php  
                 endforeach
 ?>
             
                  
                   
                </ul>

            </div>
            <div class="col-lg-4">
                <h2>Niveles de madurez</h2>
       
          <?php
          
          $nivel_0=0;
          $nivel_1=0;
          $nivel_2=0;
          $nivel_3=0;
          $nivel_4=0;

             foreach ($notaXInstitucion as $nota):
                 
                 if ($nota['Valor']!=NULL){
                     
                      if ($nota['Valor']==0){
                     $nivel_0= $nivel_0+1; 
                 }
                 if ($nota['Valor']==1){
                     $nivel_1= $nivel_1+1; 
                 }
                 if ($nota['Valor']==2){
                     $nivel_2= $nivel_2+1; 
                 }
                  if ($nota['Valor']==3){
                     $nivel_3= $nivel_3+1; 
                 }
                  if ($nota['Valor']==4){
                     $nivel_4= $nivel_4+1; 
                 }
                     
                 }

             endforeach;
   
       echo GoogleChart::widget(array('visualization' => 'PieChart',
                'data' => array(
                     array('Task', 'Hours per Day'),
                    array('Nivel 0', $nivel_0),
                    array('Nivel 1', $nivel_1),
                    array('Nivel 2', $nivel_2),
                    array('Nivel 3', $nivel_3),
                    array('Nivel 4', $nivel_4)
                ),
                'options' => array('title' => 'Niveles de madurez','height' => 300)));

        ?>
            </div>
            <div class="col-lg-4">
                <h2>Cantidad de Evaluaciones</h2>

                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6">
                                <img src="https://pbs.twimg.com/media/Db51LThUQAAaRSF.png"/>
                            </div>
                            <div class="col-xs-6 text-right">
                               
                                <h1>
                                   <?php
                echo intval($cantidad['cantidad']);
                ?>
                             </h1>     

                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer announcement-bottom">
                            <div class="row">
                                <div class="col-xs-6">
                                   <?= Html::a('Ver detalles', ['evaluaciones/generales']) ?>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <i class="fa fa-arrow-circle-right"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        
        
        <div class="row">
             <?php 
             
             
             $form = ActiveForm::begin();
             
             
             ?>
            <h2>Comportamiento por instituci&oacute;n</h2>
             <div class="col-md-4">
                 
                 
                 <?php  
             
                 echo Html::activeDropDownList($searchModel, 'Id_Institucion', ArrayHelper::map(Instituciones::find()->asArray()->all(), 'Id_Institucion', 'Nombre'), ['class'=>'form-control compor','prompt' => 'Seleccione la institución', 'onchange' => 'js:comportamiento()']); 
                 
                 
             ?>
             
             </div>
             <div class="col-md-8">
                
                .col-md-8
            </div>
            
             <?php ActiveForm::end(); ?>
 
</div>

    </div>
</div>
<script>
    
  
    
   function comportamiento()
    {
      
       
       alert($('.compor').val());
       $.ajax({
            type: "POST",
            url: "<?php echo Yii::$app->getUrlManager()->createUrl('instituciones/ajax'); ?>",
            data: {Id_Institucion:$('.compor').val()},
            success: function () {
                alert("CORECTO");
            },
            //callBack,
            error: function (exception) {
                alert(exception);
            }
        });
       
       
    }
    </script>