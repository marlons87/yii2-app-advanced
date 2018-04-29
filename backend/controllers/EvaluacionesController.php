<?php
namespace backend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use common\models\Dominios;
use common\models\Controles;
use common\models\Niveles;
use common\models\ControlesSearch;
use common\models\Respuestas;
use common\models\Evaluaciones;
//use frontend\models\EvaluacionForm;
use yii\db\Schema;



/**
 * Site controller
 */
class EvaluacionesController extends Controller
{
  
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    
    public function actionIndex($Id_Institucion,$nombre)
    {
        
                $count = Yii::$app->db->createCommand('select Id_Evaluacion,Consecutivo,Fecha,evaluaciones.Status as estado,Fecha_Ultima_Modificacion,instituciones.Nombre as institucion,user.Nombre as usuario,user.Apellido1,user.Apellido2,user.Puesto from evaluaciones inner join instituciones on evaluaciones.Id_Institucion = instituciones.Id_Institucion inner join user on evaluaciones.Id_Usuario = user.id where evaluaciones.Id_Institucion=:IdInstitucion order by Consecutivo DESC ')
               
                ->bindValue(':IdInstitucion',$Id_Institucion)
                ->queryAll();
               
     
      
      $cantidad=Yii::$app->db->createCommand('select COUNT(*) as cantidad from evaluaciones where evaluaciones.Id_Institucion=:IdInstitucion' )
               ->bindValue(':IdInstitucion',$Id_Institucion)
               ->queryOne();
      
      
      $historico =Yii::$app->db->createCommand('SELECT l.Id_Institucion, l.Id_Evaluacion, l.Consecutivo, l.Fecha, MIN(n.Valor) AS Valor FROM dominios d LEFT JOIN controles c ON d.Id_Dominio = c.Id_Dominio LEFT JOIN niveles n ON c.Id_Control = n.Id_Control LEFT JOIN respuestas r ON c.Id_Control = r.Id_Control AND n.Id_Nivel = r.Id_Nivel RIGHT JOIN (SELECT e.Id_Institucion, e.Id_Evaluacion, e.Consecutivo, e.Fecha FROM evaluaciones e) l ON r.Id_Evaluacion = l.Id_Evaluacion WHERE n.Valor >= 0 and l.Id_Institucion = :IdInstitucion GROUP BY l.Id_Institucion, l.Id_Evaluacion, l.Consecutivo ORDER BY l.Fecha asc ' )
               ->bindValue(':IdInstitucion',$Id_Institucion)
               ->queryAll();
      
      
       return $this->render('index', ['items' => $count,'nombre'=>$nombre,'cantidad'=>$cantidad,'historico'=> $historico]);
                   
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

        return $this->render('dominios', array('items' => $sql, 'calificacion' => $calificacion, 'id' => $id));
    }
    
    
    public function actionEvaluar($idEvaluacion, $idDominio,$nombre) {
        if (Yii::$app->request->post()) {
            $this->redirect(array('evaluaciones/dominios', 'id' => $idEvaluacion));
        } else {
            $dominios = Dominios::findOne($idDominio);
            $controles = $dominios->controles;
            $evaluaciones = Evaluaciones::findOne($idEvaluacion);
            $respuestas = $evaluaciones->respuestas;
            return $this->render('evaluar', array('controles' => $controles, 'respuestas' => $respuestas, 'idevaluacion' => $idEvaluacion, 'iddominio' => $idDominio,'nombre'=>$nombre));
        }
    }



}
