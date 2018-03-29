<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Dominios;
use common\models\DominiosSearch;


class EvaluacionesController extends Controller
{
    
    
    public function actionIndex()             
    {
 
     $count = Yii::$app->db->createCommand('select Id_Evaluacion,Consecutivo,Fecha,evaluaciones.Status as estado,Fecha_Ultima_Modificacion,instituciones.Nombre as institucion,user.Nombre as usuario,user.Apellido1,user.Apellido2,user.Puesto
 from evaluaciones
 inner join instituciones on evaluaciones.Id_Institucion = instituciones.Id_Institucion
 inner join user on evaluaciones.Id_Usuario = user.id
 where (instituciones.Id_Institucion =:IdInstitucion or user.id=:id) ')
             ->bindValue(':id', yii::$app->user->identity->id) 
             ->bindValue(':IdInstitucion', yii::$app->user->identity->Id_Institucion)
             ->queryAll(); 
     
     return $this->render('index', ['items'=>$count]);
}


  protected function findModel($id)
    {
        if (($model = Dominios::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


 public function actionDominios()
    {
     
          $consecutivo= Yii::$app->db->createCommand('select (MAX(Consecutivo)+1) as Consecutivo from evaluaciones where Id_Institucion=:idInstitucion')
             ->bindValue(':idInstitucion', yii::$app->user->identity->Id_Institucion) 
             ->queryOne(); 
          
     
     
    
      $sql=( new \yii\db\Query())->select('*')->from('dominios')->All();
    
       return $this->render('dominios', array('items'=>$sql));
}

public function actionControles($idEvaluacion, $idDominio) {

        //$sql = ( new \yii\db\Query())->select('*')->from('controles')->where(['Id_Dominio' => [$idDominio]]);

        $sql = (new \yii\db\Query())
                ->select('*')
                ->from('controles')
                ->where(['Id_Dominio' => $idDominio])
                ->all();

        return $this->render('controles', array('items' => $sql));
        //$model = new \common\models\Controles();
        //return $this->render('controles', ['id' =>$idEvaluacion, 'idDominio' => $idDominio,]);
        // return $this->render('controles', ['model' => $this->findModel($idDominio), ]);
        //return $this->redirect(array('evaluar', 'id' => $id, 'idDominio' => $idDominio));
    }

    }
    
    
 



?>
