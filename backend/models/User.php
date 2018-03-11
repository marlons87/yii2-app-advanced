<?php

namespace backend\models;
 
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $Id_Rol
 *
 * @property Rol $rol
 */
class User extends \common\models\User
{
    public $password;
 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        $child = [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
 
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
 
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
 
            ['Id_Rol', 'required'],
            [['Id_Rol'], 'exist', 'skipOnError' => true, 'targetClass' => Roles::className(), 'targetAttribute' => ['Id_Rol' => 'Id_Rol']],
        ];
 
        return array_merge(parent::rules(), $child);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoles()
    {
        return $this->hasOne(Roles::className(), ['Id_Rol' => 'Id_Rol']);
    }
 
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRolList()
	{
    	$Roles = Roles::find()->all();
    	$RolesList = ArrayHelper::map($Roles, 'Id_Rol', 'Descripcion');
    	return $RolesList;
	}

	public function getRolName()
	{
    	return $this->Roles ? $this->$Roles->Roles : '- no definido -';
	}
}