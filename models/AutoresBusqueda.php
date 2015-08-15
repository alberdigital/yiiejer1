<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Autores;

/**
 * AutoresBusqueda represents the model behind the search form about `app\models\Autores`.
 */
class AutoresBusqueda extends Autores
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'idpais'], 'integer'],
            [['nombre', 'apellidos'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Autores::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'idpais' => $this->idpais,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apellidos', $this->apellidos]);

        return $dataProvider;
    }
    
    public function porPais($params) {
    	$query = $this->search($params)->query;
    	
    	$dataProvider = new ActiveDataProvider([
    			'query' => $query,
    	]);
    	
    	$query->andFilterWhere([
    			'idpais' => $params['idPais']
    	]);
    	
    	return $dataProvider;
    }
}
