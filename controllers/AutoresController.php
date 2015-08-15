<?php

namespace app\controllers;

use Yii;
use app\models\Autores;
use app\models\AutoresBusqueda;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * PostController implements the CRUD actions for Autores model.
 */
class AutoresController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Autores models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AutoresBusqueda();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Muetra la lista de autores de un país.
     */
    public function actionPorPais($idPais) {
    	$searchModel = new AutoresBusqueda();
    	$gridDataProvider = $searchModel->porPais(Yii::$app->request->queryParams);

    	// Generamos todas las variables que deben estar disponibles en el javascript que hemos
    	// creado para esta página (lo llamaremos el script de autores).
    	$jsGlobals = [ 
				'idPais' => $idPais,
				'url' => Yii::$app->request->url 
		];
    	
    	return $this->render('porPais', [
    			'searchModel' => $searchModel,
    			'dataProvider' => $gridDataProvider,
    			'model' => $searchModel,

    			'jsGlobals' => Json::encode($jsGlobals)
    	]);
    }

    /**
     * Displays a single Autores model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Autores model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Autores();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Autores model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    
    
    public function actionUpdateForm($id)
    {
    	$model = $this->findModel($id);
    
    	if ($model->load(Yii::$app->request->post()) && $model->save()) {
    		
    		// ¡ATENCIÓN!: Si no devuelves nada (o si devuelves una cadena vacía), producirás una página vacía. Si Pjax recibe
    		// una página vacía, lo considera un error y provoca una redirección
    		//return $this->redirect(['view', 'id' => $model->id]);
    		
    		// Devolviemos un mensaje destinado al javascript de la página mediante un input hidden.
    		return '<div>Registro actualizado</div>
    				<input type="hidden" data-server-response="success" />';
    	} else {
    		return $this->renderAjax('_form', [
    				'model' => $model,
    		]);
    	}
    }
    

    /**
     * Deletes an existing Autores model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Autores model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Autores the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Autores::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
