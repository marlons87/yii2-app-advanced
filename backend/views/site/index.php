<?php
use yii\helpers\Html;
use scotthuangzl\googlechart\GoogleChart;
use yii\widgets\ActiveForm;
use common\models\Instituciones;
use common\models\InstitucionesSearch;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
/* @var $this yii\web\View */

$this->title = 'ECM2';

 $cantidad=$cantidad;
 


?>
<div class="site-index">
    <div class="body-content">

        <div class="row">
            <div class="col-lg-3">
                 <div class="panel panel-instituciones">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-4">
                                <a target="_self" title="Ir a instituciones" href="../instituciones/index"> <img src="https://pbs.twimg.com/media/Dct7-o4VAAEPxbe.png"/></a>
                            </div>
                            <div class="col-xs-8 text-right">
                               
                                    
                                    
                                    
                                    <?= Html::tag('h2', Html::encode(Instituciones::find()->count())) ?>
                          
                                <p> Total de Instituciones</p>

                            </div>
                        </div>
                    </div>
                  
                </div>
            </div>
            <div class="col-lg-3">
               <div class="panel panel-controles">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-4">
                               
                                <a target="_self" title="Ir a usuarios" href="../user/index"><img src="https://pbs.twimg.com/media/DcuAWHCX0AAqb75.png"/></a>
                            </div>
                            <div class="col-xs-8 text-right">
                                <h2>
                                    <?php
                                    echo intval($usuarios['usuarios']);
                                    
                                    ?>
                                </h2> 
                                <p>Usuarios</p>

                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
            <div class="col-lg-3">
               
                <div class="panel panel-usuarios">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-4">
                                <a target="_self" title="Ir a las evaluaciones" href="../evaluaciones/generales"> <img src="https://pbs.twimg.com/media/DcpnpEZV4AAbfDU.png"/></a>
                            </div>
                            <div class="col-xs-8 text-right">
                                <h2>
                                    <?php
                                    echo intval($cantidad['cantidad']);
                                    ?>
                                </h2> 
                                <p> Total de Evaluaciones</p>

                            </div>
                        </div>
                    </div>
                   
                </div>




            </div>
            <div class="col-lg-3">
               
                <div class="panel panel-dominios">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-4">
                                <a target="_self" title="Ir a dominios" href="../dominios/index"> <img src="https://pbs.twimg.com/media/Dcux3wIW4AIdppn.png"/></a>
                            </div>
                            <div class="col-xs-8 text-right">
                                <h2>
                                    <?php
                                    echo intval($dominios['dominios']);
                                    ?>
                                </h2> 
                                <p> Total de dominios</p>

                            </div>
                        </div>
                    </div>
                  
                </div>




            </div>
        </div>
   
        
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
            <div class="col-lg-8">
                
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
                'options' => array('title' => 'Niveles de madurez','height' => 400)));

        ?>
                
                
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