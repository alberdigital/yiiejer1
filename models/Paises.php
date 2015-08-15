<?php

namespace app\models;

use Yii;

class Paises extends Zonas {
	
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'paises';
	}

}

?>