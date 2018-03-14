<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "niveles".
 *
 * @property int $Id_Nivel
 * @property int $Valor
 * @property string $Descripcion
 * @property int $Id_Control
 *
 * @property Controles $control
 * @property Respuestas[] $respuestas
 */
class Niveles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'niveles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Valor', 'Id_Control'], 'integer'],
            [['Id_Control'], 'required'],
            [['Descripcion'], 'string', 'max' => 250],
            [['Id_Control'], 'exist', 'skipOnError' => true, 'targetClass' => Controles::className(), 'targetAttribute' => ['Id_Control' => 'Id_Control']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id_Nivel' => 'Id  Nivel',
            'Valor' => 'Valor',
            'Descripcion' => 'Descripcion',
            'Id_Control' => 'Id  Control',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getControl()
    {
        return $this->hasOne(Controles::className(), ['Id_Control' => 'Id_Control']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRespuestas()
    {
        return $this->hasMany(Respuestas::className(), ['Id_Nivel' => 'Id_Nivel']);
    }
}
