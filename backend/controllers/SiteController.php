<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

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
        
        $notaXInstitucion = Yii::$app->db->createCommand('select i.Id_Institucion, i.Nombre, e.Id_Evaluacion, e.Fecha, MIN(n.Valor) as Valor
FROM instituciones i 
LEFT JOIN (SELECT e1.Id_Institucion, e1.Fecha, max(e1.Id_Evaluacion) as Id_Evaluacion FROM evaluaciones e1 GROUP BY e1.Id_Institucion) e on  
i.Id_Institucion = e.Id_Institucion
LEFT JOIN respuestas r on e.Id_Evaluacion = r.Id_Evaluacion
LEFT JOIN niveles n on r.Id_Nivel = n.Id_Nivel
GROUP by i.Id_Institucion, e.Id_Evaluacion')
                ->queryAll();

        
        
        
        
        return $this->render('index',array('notaXInstitucion' => $notaXInstitucion));
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
    
      public function actionEvaluaciones()
    {
          
          echo "Hola munfd";
          
            return $this->render('evaluaciones');
    }
}
