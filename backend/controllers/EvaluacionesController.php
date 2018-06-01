<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Dominios;
use common\models\Evaluaciones;
//use frontend\models\EvaluacionForm;




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

    
    public function actionIndex($Id_Institucion)
    {
        
                  $count = Yii::$app->db->createCommand('select Id_Evaluacion,Consecutivo,Fecha,e.Status as estado,Fecha_Ultima_Modificacion,i.Nombre as institucion, s.Nombre as sede,u.Nombre as usuario,u.Apellido1,u.Apellido2,u.Puesto,e.descripcion from evaluaciones e inner join sedes s on s.id_Sede = e.id_Sede inner join instituciones i on s.Id_Institucion = i.Id_Institucion inner join user u on e.Id_Usuario = u.id where (i.Id_Institucion = :IdInstitucion)order by Id_Evaluacion DESC')
                ->bindValue(':IdInstitucion',$Id_Institucion)
                ->queryAll();
               
     
      
      $cantidad=Yii::$app->db->createCommand('select COUNT(*) as cantidad from evaluaciones where evaluaciones.Id_Institucion=:IdInstitucion' )
               ->bindValue(':IdInstitucion',$Id_Institucion)
               ->queryOne();
      
      
      $historico =Yii::$app->db->createCommand('SELECT l.Id_Institucion, l.Id_Evaluacion, l.Consecutivo, l.Fecha, MIN(n.Valor) AS Valor FROM dominios d LEFT JOIN controles c ON d.Id_Dominio = c.Id_Dominio LEFT JOIN niveles n ON c.Id_Control = n.Id_Control LEFT JOIN respuestas r ON c.Id_Control = r.Id_Control AND n.Id_Nivel = r.Id_Nivel RIGHT JOIN (SELECT e.Id_Institucion, e.Id_Evaluacion, e.Consecutivo, e.Fecha FROM evaluaciones e) l ON r.Id_Evaluacion = l.Id_Evaluacion WHERE n.Valor >= 0 and l.Id_Institucion = :IdInstitucion GROUP BY l.Id_Institucion, l.Id_Evaluacion, l.Consecutivo ORDER BY l.Fecha asc ' )
               ->bindValue(':IdInstitucion',$Id_Institucion)
               ->queryAll();
      
      
      $usuarios= Yii::$app->db->createCommand('select * from user where Id_Institucion=:IdInstitucion')
               ->bindValue(':IdInstitucion',$Id_Institucion)
               ->queryAll();
      
      
      $unico= Yii::$app->db->createCommand('SELECT l.Id_Evaluacion, l.Consecutivo, l.Fecha, d.Id_Dominio, d.Codigo as DominioCodigo, d.Nombre as DominioNombre, MIN(n.Valor) AS Valor FROM dominios d LEFT JOIN controles c ON d.Id_Dominio = c.Id_Dominio LEFT JOIN niveles n ON c.Id_Control = n.Id_Control LEFT JOIN respuestas r ON c.Id_Control = r.Id_Control AND n.Id_Nivel = r.Id_Nivel RIGHT JOIN (SELECT e.Id_Evaluacion, e.Consecutivo, e.Fecha FROM evaluaciones e WHERE e.Id_Institucion = :IdInstitucion ORDER BY e.Id_Evaluacion DESC LIMIT 1) l ON r.Id_Evaluacion = l.Id_Evaluacion WHERE n.Valor >= 0 GROUP BY l.Id_Evaluacion, l.Consecutivo, d.Id_Dominio ORDER BY d.Id_Dominio, c.Id_Control, n.Id_Nivel ASC ')
               ->bindValue(':IdInstitucion',$Id_Institucion)
               ->queryAll();
      
      
       return $this->render('index', ['items' => $count,'cantidad'=>$cantidad,'historico'=> $historico,'usuarios'=>$usuarios,'unico'=>$unico,'Id_Institucion'=>$Id_Institucion]);
                   
    }
    
    
    public function actionDominios($id,$Id_Institucion) {
        
        $sql = ( new \yii\db\Query())->select('*')->from('dominios')->All();
        $calificacion = Yii::$app->db->createCommand('select dominios.Id_Dominio, dominios.Codigo as DominioCodigo, dominios.Nombre as DominioNombre, controles.Id_Control, controles.Codigo, controles.Nombre, niveles.Valor,respuestas.Observaciones
        from dominios
        LEFT join controles on dominios.Id_Dominio = controles.Id_Dominio
        left join niveles on controles.Id_Control = niveles.Id_Control
        left join respuestas on controles.Id_Control = respuestas.Id_Control and niveles.Id_Nivel = respuestas.Id_Nivel
        where (respuestas.Id_Evaluacion is null OR respuestas.Id_Evaluacion = :id) and respuestas.Id_Nivel IS NOT null
        order by dominios.Id_Dominio, controles.Id_Control, niveles.Id_Nivel ASC')
                ->bindValue(':id', $id)
                ->queryAll();
        
      $evaluacion = Yii::$app->db->createCommand('SELECT e.Id_Evaluacion, Consecutivo, descripcion, i.Nombre, e.Fecha, e.Fecha_Ultima_Modificacion FROM evaluaciones e INNER JOIN sedes s on e.Id_Sede = s.Id_Sede INNER JOIN instituciones i ON s.Id_Institucion = i.Id_Institucion and e.Id_Evaluacion=:id')
                ->bindValue(':id', $id)
                ->queryOne();
        
        

        return $this->render('dominios', array('items' => $sql, 'calificacion' => $calificacion, 'id' => $id,'Id_Institucion'=>$Id_Institucion,'evaluacion'=>$evaluacion));
    }
    
    
    public function actionEvaluar($idEvaluacion, $idDominio,$Id_Institucion) {
        if (Yii::$app->request->post()) {
            $this->redirect(array('evaluaciones/dominios', 'id' => $idEvaluacion));
        } else {
            $dominios = Dominios::findOne($idDominio);
            $controles = $dominios->controles;
            $evaluaciones = Evaluaciones::findOne($idEvaluacion);
            $respuestas = $evaluaciones->respuestas;
            return $this->render('evaluar', array('controles' => $controles, 'respuestas' => $respuestas, 'idevaluacion' => $idEvaluacion,'dominios'=>$dominios,'Id_Institucion' => $Id_Institucion));
        }
    }
    
    
    public function actionGenerales() {
        
        $evaluaciones = Yii::$app->db->createCommand('SELECT e.Id_Evaluacion, s.id_Sede, s.Nombre as Sede ,Fecha,Fecha_Ultima_Modificacion, i.Nombre as institucion,i.Id_Institucion,u.Nombre,u.Apellido1,u.Apellido2,Consecutivo,e.descripcion FROM evaluaciones e INNER JOIN sedes s on e.id_Sede = s.id_Sede INNER JOIN instituciones i on s.Id_Institucion = i.Id_Institucion INNER JOIN user u ON e.Id_Usuario = u.id ORDER BY e.Id_Evaluacion DESC ')
               
                ->queryAll();
        
         return $this->render('generales', array('evaluaciones' => $evaluaciones));
        
    }
    
      
    public function actionInstituciones() {
        
        $Instituciones = Yii::$app->db->createCommand('SELECT * FROM instituciones')
               
                ->queryAll();
        
        
          $notaXInstitucion = Yii::$app->db->createCommand('SELECT i.Id_Institucion, i.Nombre AS Nombre, e.Id_Sede, s.Nombre AS Sede, e.Id_Evaluacion, e.Consecutivo, e.Fecha, e.descripcion, MIN(n.Valor) AS Valor
FROM evaluaciones e 
INNER JOIN respuestas r ON e.Id_Evaluacion = r.Id_Evaluacion
INNER JOIN niveles n ON r.Id_Nivel = n.Id_Nivel
INNER JOIN sedes s ON e.Id_Sede = s.Id_Sede
INNER JOIN instituciones i ON s.Id_Institucion = i.Id_Institucion
INNER JOIN (SELECT e1.Id_Sede, MAX(e1.Id_Evaluacion) Id_Evaluacion FROM evaluaciones e1 INNER JOIN respuestas r1 ON e1.Id_Evaluacion = r1.Id_Evaluacion GROUP BY e1.Id_Sede) e2
on e.Id_Evaluacion = e2.Id_Evaluacion
WHERE n.Valor > -1
GROUP BY i.Id_Institucion, e.Id_Sede, e.Id_Evaluacion')
                ->queryAll();
        
         return $this->render('instituciones', array('instituciones' => $Instituciones,'notas'=>$notaXInstitucion));
        
    }



}
