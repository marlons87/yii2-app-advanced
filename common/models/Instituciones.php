<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "instituciones".
 *
 * @property int $Id_Institucion
 * @property string $Nombre
 *
 * @property Usuarios[] $usuarios
 */
class Instituciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'instituciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['Nombre', 'trim'],
            [['Nombre'], 'required', 'message' => 'Complete el nombre de la Institución.'],
            ['Nombre','unique','message' => 'La institución ya ha sido creada previamente.'],
            [['Nombre'], 'string', 'max' => 100]];
        
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id_Institucion' => 'ID',
            'Nombre' => 'Nombre',
          
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuarios::className(), ['Id_Institucion' => 'Id_Institucion']);
    }
}
