<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "autores".
 *
 * @property integer $id
 * @property integer $idpais
 * @property string $nombre
 * @property string $apellidos
 *
 * @property Paises $idpais0
 * @property Libros[] $libros
 */
class Autores extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'autores';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idpais', 'nombre', 'apellidos'], 'required'],
            [['idpais'], 'integer'],
            [['nombre'], 'string', 'max' => 50],
            [['apellidos'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idpais' => 'Idpais',
        	'idpais0.nombre' => 'País',
            'nombre' => 'Nombre',
            'apellidos' => 'Apellidos',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdpais0()
    {
        return $this->hasOne(Paises::className(), ['id' => 'idpais']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLibros()
    {
        return $this->hasMany(Libros::className(), ['idautor' => 'id']);
    }
}
