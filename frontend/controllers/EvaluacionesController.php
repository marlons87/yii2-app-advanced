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
        
     $count = Yii::$app->db->createCommand('SELECT * FROM {{evaluaciones}} WHERE [[Id_Usuario]]=:id')
             ->bindValue(':id', yii::$app->user->identity->id)
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
