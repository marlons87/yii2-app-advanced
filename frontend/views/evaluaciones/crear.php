<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use common\models\Evaluaciones;
use common\models\Sedes;
use common\models\SedesSearch;
use common\models\User\User;

$descripcion = "";
$this->title = 'Crear evaluación';

$this->params['breadcrumbs'][] = ['label' => 'Evaluaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

 <h1><?= Html::encode($this->title) ?></h1>
 
 <?php $form = ActiveForm::begin([
      "method" => "post",
     
     
     
]) ?>
  
  
<?= $form->field($model, 'Id_Institucion')->dropDownList($model->SedesList , ['prompt' => 'Seleccione...'])->label('Sedes')  ?>
 
 <label for="descripcion" >Descripci&oacute;n  </label>
  <textarea class="txtObservaciones" id="descripcion" maxlength="250"  name="txtObservaciones" style="width:100%"><?= (trim($descripcion)); ?></textarea>

    <div class="form-group">
      
            <?= Html::submitButton('Crear evaluacion', ['class' => 'btn btn-success', 'value' => 'my_value','onClick' => 'js:sendData()']) ?>
       
    </div>
<?php ActiveForm::end() ?>

  <script>
      
          function sendData() {
             
             $.ajax({
            type: "POST",
            url: "<?php echo Yii::$app->getUrlManager()->createUrl('evaluaciones/insertar'); ?>",
            data: {descripcion: $('#descripcion').val()},
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



