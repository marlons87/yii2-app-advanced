<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Instituciones;
use common\models\InstitucionesSearch;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
         if (Yii::$app->request->post()) {
            $this->redirect(array('site/index', 'historico' => $historico));
        } else {
        
         $searchModel = new InstitucionesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $notaXInstitucion = Yii::$app->db->createCommand('SELECT i.Id_Institucion, i.Nombre, s.Id_Sede, s.Nombre, e.Id_Evaluacion, MAX(e.Consecutivo), r2.Valor
FROM evaluaciones e
INNER JOIN sedes s ON e.Id_Sede = s.Id_Sede
INNER JOIN instituciones i ON s.Id_Institucion = i.Id_Institucion
LEFT JOIN (SELECT Id_Evaluacion, MIN(n.Valor) AS Valor
FROM respuestas r INNER JOIN niveles n ON r.Id_Nivel = n.Id_Nivel
WHERE n.Valor >= 0
GROUP BY r.Id_Evaluacion) r2 ON e.Id_Evaluacion = r2.Id_Evaluacion

GROUP BY i.Id_Institucion, s.Id_Sede')
                ->queryAll();
        
     $cantidadEvaluacion =   Yii::$app->db->createCommand('select COUNT(*)as cantidad from evaluaciones')
               ->queryOne();
     
     $usuarios =   Yii::$app->db->createCommand("select count(*) as usuarios from user WHERE STATUS=10")
       ->queryOne();
     
      $dominios =   Yii::$app->db->createCommand("select count(*) as dominios from dominios")
       ->queryOne();
     
        
        return $this->render('index',array('notaXInstitucion' => $notaXInstitucion,'cantidad'=>$cantidadEvaluacion,'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,'usuarios'=>$usuarios,'dominios'=>$dominios));
        
        }
    }
    
    
    

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
     
     public function actionAjax() {
       
        $Id_Institucion = Yii::$app->request->post('Id_Institucion');
        
       
        
        $historico =Yii::$app->db->createCommand('SELECT l.Id_Institucion, l.Id_Evaluacion, l.Consecutivo, l.Fecha, MIN(n.Valor) AS Valor FROM dominios d LEFT JOIN controles c ON d.Id_Dominio = c.Id_Dominio LEFT JOIN niveles n ON c.Id_Control = n.Id_Control LEFT JOIN respuestas r ON c.Id_Control = r.Id_Control AND n.Id_Nivel = r.Id_Nivel RIGHT JOIN (SELECT e.Id_Institucion, e.Id_Evaluacion, e.Consecutivo, e.Fecha FROM evaluaciones e) l ON r.Id_Evaluacion = l.Id_Evaluacion WHERE n.Valor >= 0 and l.Id_Institucion = :IdInstitucion GROUP BY l.Id_Institucion, l.Id_Evaluacion, l.Consecutivo ORDER BY l.Fecha asc ' )
               ->bindValue(':IdInstitucion',$Id_Institucion)
               ->queryAll();
        
         $unico= Yii::$app->db->createCommand('SELECT l.Id_Evaluacion, l.Consecutivo, l.Fecha, d.Id_Dominio, d.Codigo as DominioCodigo, d.Nombre as DominioNombre, MIN(n.Valor) AS Valor FROM dominios d LEFT JOIN controles c ON d.Id_Dominio = c.Id_Dominio LEFT JOIN niveles n ON c.Id_Control = n.Id_Control LEFT JOIN respuestas r ON c.Id_Control = r.Id_Control AND n.Id_Nivel = r.Id_Nivel RIGHT JOIN (SELECT e.Id_Evaluacion, e.Consecutivo, e.Fecha FROM evaluaciones e WHERE e.Id_Institucion = :IdInstitucion ORDER BY e.Id_Evaluacion DESC LIMIT 1) l ON r.Id_Evaluacion = l.Id_Evaluacion WHERE n.Valor >= 0 GROUP BY l.Id_Evaluacion, l.Consecutivo, d.Id_Dominio ORDER BY d.Id_Dominio, c.Id_Control, n.Id_Nivel ASC ')
               ->bindValue(':IdInstitucion',$Id_Institucion)
               ->queryAll();
         
         
          return $this->render('site/index', ['historico'=> $historico,'unico'=>$unico]);
       
    }
    
  
    
    
}
