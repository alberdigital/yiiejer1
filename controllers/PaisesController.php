<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Paises;

class PaisesController extends Controller {

	public function actionIndex() {
		
		$pais = Paises::obtenerPaisPorId(1);
		
		return $pais->nombre;
		
	}
	
}

?>