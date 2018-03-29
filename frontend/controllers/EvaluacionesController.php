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


public function actionEvaluar($id)
        
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['evaluar', 'id' => $model->Id_Dominio]);
        }

        return $this->render('evaluar', [
            'model' => $model,
        ]);
    }

    }
    
    
 



?>
