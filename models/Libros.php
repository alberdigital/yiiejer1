<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "libros".
 *
 * @property integer $id
 * @property integer $idautor
 * @property string $titulo
 *
 * @property Autores $idautor0
 */
class Libros extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'libros';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idautor', 'titulo'], 'required'],
            [['idautor'], 'integer'],
            [['titulo'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idautor' => 'Idautor',
            'titulo' => 'Titulo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdautor0()
    {
        return $this->hasOne(Autores::className(), ['id' => 'idautor']);
    }
}
