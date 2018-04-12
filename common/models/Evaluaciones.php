<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "evaluaciones".
 *
 * @property int $Id_Evaluacion
 * @property int $Consecutivo
 * @property string $Fecha
 * @property int $Status
 * @property int $Id_Usuario
 * @property int $Id_Institucion
 * @property string $Fecha_Ultima_Modificacion
 *
 * @property User $usuario
 * @property Instituciones $institucion
 * @property Respuestas[] $respuestas
 */
class Evaluaciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'evaluaciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Consecutivo', 'Id_Usuario', 'Id_Institucion'], 'integer'],
            [['Fecha', 'Fecha_Ultima_Modificacion'], 'safe'],
            [['Id_Usuario', 'Id_Institucion'], 'required'],
            [['Status'], 'string', 'max' => 1],
            [['Id_Usuario'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['Id_Usuario' => 'id']],
            [['Id_Institucion'], 'exist', 'skipOnError' => true, 'targetClass' => Instituciones::className(), 'targetAttribute' => ['Id_Institucion' => 'Id_Institucion']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id_Evaluacion' => 'Id  Evaluacion',
            'Consecutivo' => 'Consecutivo',
            'Fecha' => 'Fecha',
            'Status' => 'Status',
            'Id_Usuario' => 'Id  Usuario',
            'Id_Institucion' => 'Id  Institucion',
            'Fecha_Ultima_Modificacion' => 'Fecha  Ultima  Modificacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'Id_Usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstitucion()
    {
        return $this->hasOne(Instituciones::className(), ['Id_Institucion' => 'Id_Institucion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRespuestas()
    {
        return $this->hasMany(Respuestas::className(), ['Id_Evaluacion' => 'Id_Evaluacion']);
    }
    
    /**
     * @inheritdoc
     * @return EvaluacionesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EvaluacionesQuery(get_called_class());
    }
}
