<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Dominios;
use common\models\Controles;
use common\models\Niveles;
use common\models\ControlesSearch;
use common\models\Respuestas;
use common\models\Evaluaciones;
use frontend\models\EvaluacionForm;
use backend\models\User\User;
use common\models\SedesSearch;
use common\models\Sedes;
use common\models\Instituciones;
use common\models\InstitucionesSearch;
use yii\helpers\ArrayHelper;


class EvaluacionesController extends Controller {

    public function actionIndex() {
        
        
        
          if (!Yii::$app->user->isGuest){
              
               $count = Yii::$app->db->createCommand('select Id_Evaluacion,Consecutivo,Fecha,e.Status as estado,Fecha_Ultima_Modificacion,i.Nombre as institucion, s.Nombre as sede,u.Nombre as usuario,u.Apellido1,u.Apellido2,u.Puesto,e.descripcion from evaluaciones e inner join sedes s on s.id_Sede = e.id_Sede inner join instituciones i on s.Id_Institucion = i.Id_Institucion inner join user u on e.Id_Usuario = u.id where (i.Id_Institucion = :IdInstitucion or u.id = :id)order by Id_Evaluacion DESC')
                ->bindValue(':id', yii::$app->user->identity->id)
                ->bindValue(':IdInstitucion', yii::$app->user->identity->Id_Institucion)
                ->queryAll();

        return $this->render('index', ['items' => $count]);
           
          }else{
              
              
                
                   return $this->render('../site/index');
          }


       
    }

    protected function findModel($id) {
        if (($model = Dominios::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDominios($id) {
        
        $sql = ( new \yii\db\Query())->select('*')->from('dominios')->All();
        $calificacion = Yii::$app->db->createCommand('select dominios.Id_Dominio, dominios.Codigo as DominioCodigo, dominios.Nombre as DominioNombre, controles.Id_Control, controles.Codigo, controles.Nombre, niveles.Valor
        from dominios
        LEFT join controles on dominios.Id_Dominio = controles.Id_Dominio
        left join niveles on controles.Id_Control = niveles.Id_Control
        left join respuestas on controles.Id_Control = respuestas.Id_Control and niveles.Id_Nivel = respuestas.Id_Nivel
        where (respuestas.Id_Evaluacion is null OR respuestas.Id_Evaluacion = :id) and respuestas.Id_Nivel IS NOT null
        order by dominios.Id_Dominio, controles.Id_Control, niveles.Id_Nivel ASC')
                ->bindValue(':id', $id)
                ->queryAll();
        
             $evaluacion  = Yii::$app->db->createCommand('SELECT Id_Evaluacion,Consecutivo,descripcion,instituciones.Nombre,evaluaciones.Fecha,evaluaciones.Fecha_Ultima_Modificacion
FROM evaluaciones INNER JOIN instituciones ON evaluaciones.Id_Institucion=instituciones.Id_Institucion and evaluaciones.Id_Evaluacion=:id')
                 ->bindValue(':id', $id)
                  ->queryOne();

        return $this->render('dominios', array('items' => $sql, 'calificacion' => $calificacion, 'id' => $id,'evaluacion'=>$evaluacion));
    }

    public function actionInsertar() {
        
       
        
          $descripcion = Yii::$app->request->post('descripcion');
       
        $consecutivo = Yii::$app->db->createCommand('select (MAX(Consecutivo)+1) as Consecutivo from evaluaciones e inner join sedes  s on e.id_Sede = s.id_sede where Id_Institucion =:idInstitucion')
                ->bindValue(':idInstitucion', yii::$app->user->identity->Id_Institucion)
                ->queryOne();
        
        
        
        if (is_null($consecutivo['Consecutivo'])){
              $consecutivo['Consecutivo']=1;
        }
        
   

        Yii::$app->db->createCommand()->insert('evaluaciones', [
            'Consecutivo' => $consecutivo['Consecutivo'],
            'Fecha' => date('Y-m-d H:i:s'),
            'Status' => 0,
            'Id_Usuario' => yii::$app->user->identity->Id,
            'Id_Institucion' => yii::$app->user->identity->Id_Institucion,
            'Fecha_Ultima_Modificacion' => date('Y-m-d H:i:s'),
            'descripcion'=>$descripcion
            ])
                
                
                ->execute();

        $evaluacion = Yii::$app->db->createCommand('SELECT LAST_INSERT_ID() as evaluacion')
                ->queryOne();

        $sql = ( new \yii\db\Query())->select('*')->from('dominios')->All();
     return $this->render('dominios', array('id' => $evaluacion));
    }
    
    
      public function actionCrear() {
        
        $searchModel = new InstitucionesSearch(); 
        $searchModel->Id_Institucion = yii::$app->user->identity->Id_Institucion ;
        $model = new Instituciones();
        $model = Instituciones::findOne($searchModel);
        
        return $this->render('crear', ['model' => $model
        ]);
          
        
    }

    public function actionControles($idEvaluacion, $idDominio) {
        $sql = (new \yii\db\Query())
                ->select(['{{controles}}.id_Control, {{controles}}.Nombre, {{controles}}.Codigo, {{niveles}}.Id_Nivel, {{niveles}}.Valor, {{niveles}}.Descripcion', '(CASE when respuestas.Id_Control IS NULL then 0 else 1 END) as Active',])
                ->from('controles')
                ->leftJoin('niveles', 'controles.Id_Control = niveles.Id_Control')
                ->leftJoin('respuestas', 'controles.Id_Control = respuestas.Id_Control')
                ->Where(['and', ['controles.Id_Dominio' => $idDominio], ['or', ['respuestas.Id_Evaluacion' => null], ['respuestas.Id_Evaluacion' => $idEvaluacion]]])
                ->all();
//Se deben incluier los Niveles de cada control y determinar cual esta saleccionado por el usuario si ya existe una evaluacion
        return $this->render('controles', array('items' => $sql));
    }

    public function actionEvaluar($idEvaluacion, $idDominio) {
        if (Yii::$app->request->post()) {
            $this->redirect(array('evaluaciones/dominios', 'id' => $idEvaluacion));
        } else {
            $dominios = Dominios::findOne($idDominio);
            $controles = $dominios->controles;
            $evaluaciones = Evaluaciones::findOne($idEvaluacion);
            $respuestas = $evaluaciones->respuestas;
            return $this->render('evaluar', array('controles' => $controles, 'respuestas' => $respuestas, 'idevaluacion' => $idEvaluacion, 'dominios'=>$dominios));
        }
    }

    public function actionPruebas2($idEvaluacion, $idDominio) {
        $evaluacion = Evaluaciones::findOne($idEvaluacion);
        $respuestas = $evaluacion->respuestas;
        $control = $respuestas->control;
        $niveles = $control->niveles;
        //var_dump($respuestas);
        //Se deben incluier los Niveles de cada control y determinar cual esta saleccionado por el usuario si ya existe una evaluacion
        return $this->render('pruebas2', array('respuestas' => $respuestas));
    }

    //Controller file code
    public function actionAjax() {
        
       
        
        
        $data = Yii::$app->request->post('niveles');
        $observaciones = Yii::$app->request->post('observaciones');
        $idEvaluacion = Yii::$app->request->post('idEvaluacion');
        
        //$Evaluacion = Evaluaciones::findOne($idEvaluacion);
        if (isset($data)) {
            foreach ($data as $respuesta) {
                $nivel = Niveles::findOne($respuesta);
                $control = $nivel['Id_Control'];
                //Asignar el comentario de cada control
                $comentario = '';
                foreach ($observaciones as $observacion) {
                    $myArray = \explode('~', $observacion);
                    $aux = (int) $myArray[0];
                    if ((int) $myArray[0] === $control) {
                        $comentario = trim($myArray[1]);
                        break;
                    }
                }

                $respuestaactual = Respuestas::find()
                        ->where(['Id_Evaluacion' => $idEvaluacion])
                        ->andWhere(['Id_Control' => $control])
                        ->andWhere(['Id_Nivel' => $respuesta])
                        ->one();
                if (!$respuestaactual['Id_Respuesta']) {
                    $respuestaactual = Respuestas::find()
                            ->where(['Id_Evaluacion' => $idEvaluacion])
                            ->andWhere(['Id_Control' => $control])
                            ->one();
                    if (!$respuestaactual['Id_Respuesta']) {  //Inserta uno nuevo
                        $respuestanueva = new Respuestas();
                        $respuestanueva->Id_Nivel = $respuesta;
                        $respuestanueva->Id_Evaluacion = $idEvaluacion;
                        $respuestanueva->Id_Control = $control;
                        $respuestanueva->Observaciones = $comentario;
                        $respuestanueva->save();
                    } else {//Actualizar
                        $respuestaactual->Id_Nivel = intval($respuesta);
                        $respuestaactual->Observaciones = $comentario;
                        $respuestaactual->save();
                    }
                } else {//Actualizar
                    //$respuestaactual->Id_Nivel= intval($respuesta);
                    $respuestaactual->Observaciones = $comentario;
                    $respuestaactual->save();
                    
                }
            }
            $test = "Acción ejecutada exitosamente";            
            Yii::$app->db->createCommand()
            ->update('evaluaciones', ['Fecha_Ultima_Modificacion' =>  date('Y-m-d H:i:s')], 'Id_Evaluacion =:idEvaluacion')
            ->bindValue(':idEvaluacion', $idEvaluacion)
            ->execute();
            
            
        } else {
            $test = "Error al ejecutar la acción";
        }
        return \yii\helpers\Json::encode($test);
    }

    public function actionResponder($id, $Id_Dominio, $idNivel) {

        echo "El id de la evaluacion es " . $id . " el id del dominio es " . $Id_Dominio . " el nivel es " . $idNivel;
    }
    
    
    
  

}
