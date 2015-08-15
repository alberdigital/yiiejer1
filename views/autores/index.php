<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Paises;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AutoresBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Autores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="autores-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Autores', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            
            // Opción 1.
            //'idpais0.nombre',
             
            // Opción 2: Con filtrado por páis (mediante selector) y generando un link a la página de autores por país.
            [
	            
	            // Para que se cree el selector que filtra por esta columna.
	            // El método map cambia 
	            //    [ [id=>1, nombre=>España], [id=>2, nombre=>USA] ] 
	            // por:
	            //    [ [1=>España], [2=>USA] ]  
	            // Ver: http://www.yiiframework.com/forum/index.php/topic/49479-gridview-with-foreign-key/
            	'attribute' => 'idpais',
	            'filter' => ArrayHelper::map(Paises::find()->asArray()->all(), 'id', 'nombre'),
	            
	            'label' => 'País',
	            // Link a la página de autores por país.
	            
	            'content' => function ($model, $key, $index, $column) {
	            	return Html::a( 
	            			$model->idpais0->nombre,
	            			['autores/por-pais', 'idPais' => $model->idpais0->id],
	            			['data-pjax' => 0]
	            	);
	            }
            ],
            
            'nombre',
            'apellidos',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
