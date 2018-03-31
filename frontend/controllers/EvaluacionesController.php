<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Dominios;


class EvaluacionesController extends Controller {

    public function actionIndex() {

        $count = Yii::$app->db->createCommand('select Id_Evaluacion,Consecutivo,Fecha,evaluaciones.Status as estado,Fecha_Ultima_Modificacion,instituciones.Nombre as institucion,user.Nombre as usuario,user.Apellido1,user.Apellido2,user.Puesto
 from evaluaciones
 inner join instituciones on evaluaciones.Id_Institucion = instituciones.Id_Institucion
 inner join user on evaluaciones.Id_Usuario = user.id
 where (instituciones.Id_Institucion =:IdInstitucion or user.id=:id) ')
                ->bindValue(':id', yii::$app->user->identity->id)
                ->bindValue(':IdInstitucion', yii::$app->user->identity->Id_Institucion)
                ->queryAll();

        return $this->render('index', ['items' => $count]);
    }

    protected function findModel($id) {
        if (($model = Dominios::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    
     public function actionDominios() {
         
            $sql = ( new \yii\db\Query())->select('*')->from('dominios')->All();

      return $this->render('dominios', array('items' => $sql));
         
     }
    
    

    public function actionInsertar() {

        $consecutivo = Yii::$app->db->createCommand('select (MAX(Consecutivo)+1) as Consecutivo from {{evaluaciones}} where [[Id_Institucion]]=:idInstitucion')
                ->bindValue(':idInstitucion', yii::$app->user->identity->Id_Institucion)
                ->queryOne();

        Yii::$app->db->createCommand()->insert('evaluaciones', [
            'Consecutivo' => $consecutivo['Consecutivo'],
            'Fecha' => date('Y-m-d H:i:s'),
            'Status' => 0,
            'Id_Usuario' => yii::$app->user->identity->Id,
            'Id_Institucion' => yii::$app->user->identity->Id_Institucion,
            'Fecha_Ultima_Modificacion' => date('Y-m-d H:i:s'),])->execute();
        
        
        
        
        
     

        $evaluacion = Yii::$app->db->createCommand('SELECT LAST_INSERT_ID() as evaluacion')
                ->queryOne();
        

        $sql = ( new \yii\db\Query())->select('*')->from('dominios')->All();

      return $this->render('dominios', array('items' => $sql,'evaluacion'=>$evaluacion));
    }

    public function actionControles($idEvaluacion, $idDominio) {
        $sql = (new \yii\db\Query())
                ->select(['{{controles}}.*', '(CASE when respuestas.Id_Control IS NULL then 0 else 1 END) as Active',])
                ->from('controles')
                ->leftJoin('respuestas', 'controles.Id_Control = respuestas.Id_Control')
                ->Where(['and', ['controles.Id_Dominio' => $idDominio], ['or', ['respuestas.Id_Evaluacion' => null], ['respuestas.Id_Evaluacion' => $idEvaluacion]]])
                ->all();
//Se deben incluier los Niveles de cada control y determinar cual esta saleccionado por el usuario si ya existe una evaluacion
        return $this->render('controles', array('items' => $sql));
    }
    

    
    


}

?>
