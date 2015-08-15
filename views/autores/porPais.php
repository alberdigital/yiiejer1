<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\widgets\ActiveFormAsset;
use yii\web\View;
use yii\jui\Dialog;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AutoresBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */


// Registramos los assets para el active form. Aunque el active form no se usa directamente en esta página, será cargado 
// más adelante mediante pjax. Pjax ejecuta todos los scripts en línea de los contenidos cargados. Sin embargo, no carga
// ficheros js externos. Cuando generamos el contenido usando renderAjax, obtenemos todos los tags <script/> necesarios para
// renderizar el contenido (todos los que estén registrados), pero solo se ejecutan los scripts en línea. Por ejemplo, al
// cargar un contenido con un ActiveForm, se ejecutará la llamada a $(...).yiiActiveForm(), pero no se cargará perviamente el
// fichero yii.activeForm.js, así que fallará. Por eso es necesario registrar todos los assets que vayan a ser necesarios en
// los contenidos que más tarde se cargarán mediante ajax. No hay peligro de que se incluyan dos veces, porque la función
// register gestiona eso correctamente.
// Nota: Se pueden registrar estos assets en el fichero de layout, de forma que estén disponibles en todas partes. Así será más 
// cómodo y cometeremos menos errores, pero también es más ineficiente, porque algunas páginas cargarán recursos innecesarios. 
ActiveFormAsset::register($this);

$this->title = 'Autores por país';
$this->params['breadcrumbs'][] = ['label' => 'Autores', 'url' => ['autores/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="autores-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Autores', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?php 
    Pjax::begin([
    	'id' => 'listado',
    	'timeout' => 5000, // El timeout por defecto es muy bajo. Agotado el timeout, se produce una redirección, y no queremos eso.
    	'enablePushState' => false,
    ]);
    
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
        	//'idpais0.nombre',
            'nombre',
            'apellidos',

            [
            	'class' => 'yii\grid\DataColumn',
				'content' => function ($model, $key, $index, $column) {
					return Html::a(
							'Edit',
							['autores/update-form', 'id' => $key],
							[
									'data-pjax' => 0,
									'class' => 'edit-link'
							]
					);
    			}
            ]
            
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); 
     
    Pjax::end();
    ?>
    
    <?php 
    Dialog::begin([
    	'id' => 'popup-edicion',
	    'clientOptions' => [
	        'modal' => true,
	        'autoOpen' => false
	    ],
	]);
    ?>
    
    <?php 
    Pjax::begin([
    	'id' => 'edit-container',
    	'timeout' => 5000,
    	'enablePushState' => false,
    ]);
    
    Pjax::end();
    ?>
    
    <?php 
    Dialog::end();
    ?>

    <?php 
    
    // Registra el array de variables globales de la página en el <head />.
    // Eso garantiza que está disponible para el fichero autores.js, que se carga al final del <body />.
    $this->registerJs("var jsGlobals = $jsGlobals;", View::POS_HEAD);
    
    $this->registerJsFile(
    		Url::to('@web/js/autores.js'),
    		[ 'depends' => [\yii\web\JqueryAsset::className()] ]);
    
    ?>
</div>
