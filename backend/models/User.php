<?php

namespace backend\models;
 
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $Nombre
 * @property string $Apellido1
 * @property string $Apellido2
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $Status
 * @property int $created_at
 * @property int $updated_at
 * @property int $Id_Rol
 *
 * @property Rol $rol
 */
class User extends \common\models\User
{
    public $password;
    public $passCompare;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            
            [['Nombre'], 'string', 'max' => 50],
            
                        [['Apellido1'], 'string', 'max' => 30],

                        [['Apellido2'], 'string', 'max' => 30],
            
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
                       ['password', 'compare', 'compareAttribute'=>'passCompare','on'=>'create'],

   
            ['Id_Rol', 'required'],
            [['Id_Rol'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\Roles::className(), 'targetAttribute' => ['Id_Rol' => 'Id_Rol']],
            
            ['Id_Institucion', 'required'],
            [['Id_Institucion'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\Instituciones::className(), 'targetAttribute' => ['Id_Institucion' => 'Id_Institucion']],
        ];
 
        //return array_merge(parent::rules(), $child);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoles()
    {
        return $this->hasOne(\common\models\Roles::className(), ['Id_Rol' => 'Id_Rol']);
    }
 
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRolList()
	{
    	$Roles = \common\models\Roles::find()->all();
    	$RolesList = ArrayHelper::map($Roles, 'Id_Rol', 'Descripcion');
    	return $RolesList;
	}

	public function getRolName()
	{
    	return $this->Roles ? $this->$Roles->Roles : '- no definido -';
	}
        
         /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstituciones()
    {
        return $this->hasOne(\common\models\Instituciones::className(), ['Id_Institucion' => 'Id_Institucion']);
    }
 
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstitucionList()
	{
    	$Instituciones = \common\models\Instituciones::find()->all();
    	$InstitucionesList = ArrayHelper::map($Instituciones, 'Id_Institucion', 'Nombre');
    	return $InstitucionesList;
	}

	public function getInstitucionName()
	{
    	return $this->Instituciones ? $this->$Instituciones->Instituciones : '- no definido -';
	}
}