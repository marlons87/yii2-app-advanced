<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;


class EvaluacionesController extends Controller
{
    
    
    public function actionIndex()
    {
    
       $sql=( new \yii\db\Query())->select('*')->from('dominios')->All();
    
       return $this->render('index', [
            'consulta' => $sql
           
        ]);
       
}

    }



?>
