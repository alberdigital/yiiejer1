<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "paises".
 *
 * @property integer $id
 * @property string $nombre
 *
 * @property Autores[] $autores
 */
class Zonas extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 50]
        ];
    }

    public static function tableName()
    {
    	return 'zonas';
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
        ];
    }
    
    public static function obtenerPaisPorId($id) {
    	Yii::trace('Obteniendo país por id.', 'aebf\\demo\\' . __METHOD__);
    	return self::find()->where(['id' => $id])->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAutores()
    {
        return $this->hasMany(Autores::className(), ['idpais' => 'id']);
    }
}
