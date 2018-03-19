<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "dominios".
 *
 * @property int $Id_Dominio
 * @property string $Nombre
 * @property string $Codigo
 *
 * @property Controles[] $controles
 */
class Dominios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dominios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nombre', 'Codigo'], 'required'],
            [['Nombre'], 'string', 'max' => 50],
            [['Codigo'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id_Dominio' => 'ID',
            'Codigo' => 'Código',
            'Nombre' => 'Nombre',
          
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getControles()
    {
        return $this->hasMany(Controles::className(), ['Id_Dominio' => 'Id_Dominio']);
    }
}
