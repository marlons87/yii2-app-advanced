<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "controles".
 *
 * @property int $Id_Control
 * @property string $Nombre
 * @property int $Id_Dominio
 * @property string $Codigo
 *
 * @property Dominios $dominio
 * @property Niveles[] $niveles
 */
class Controles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'controles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
       return [
            [['Nombre', 'Id_Dominio', 'Codigo'], 'required'],
            [['Nombre'], 'string', 'max' => 100],
            [['Codigo'], 'string', 'max' => 10],
            
             ['Id_Dominio', 'integer'],
            [['Id_Dominio'], 'exist', 'skipOnError' => true, 'targetClass' => Dominios::className(), 'targetAttribute' => ['Id_Dominio' => 'Id_Dominio']],
        ]; 
        
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id_Control' => 'ID',
            'Nombre' => 'Nombre',
            'Id_Dominio' => 'Dominio',
            'Codigo' => 'Código',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
   

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNiveles()
    {
        return $this->hasMany(Niveles::className(), ['Id_Control' => 'Id_Control']);
    }
    
     public function getDominio()
    {
        return $this->hasOne(Dominios::className(), ['Id_Dominio' => 'Id_Dominio']);
    }
    
     public function getDominioList()
	{
    	$Dominio = Dominios::find()->all();
    	$DominioList = ArrayHelper::map($Dominio, 'Id_Dominio', 'Nombre');
    	return $DominioList;
	}

	public function getDominioName()
	{
    	return $this->dominio ? $this->$dominio->dominio : '- no definido -';
	}
    
    
    
}
