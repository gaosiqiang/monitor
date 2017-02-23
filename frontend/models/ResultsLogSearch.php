<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ResultsLog;

/**
 * ResultsLogSearch represents the model behind the search form about `frontend\models\ResultsLog`.
 */
class ResultsLogSearch extends ResultsLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'total', 'date_month', 'date_day', 'date_hour', 'date_minute'], 'integer'],
            [['method', 'site_name', 'param_name', 'svc_ip'], 'safe'],
            [['amount'], 'number'],
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
        //old code
        /*
        $query = ResultsLog::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'total' => $this->total,
            'amount' => $this->amount,
            'date_month' => $this->date_month,
            'date_day' => $this->date_day,
            'date_hour' => $this->date_hour,
            'date_minute' => $this->date_minute,
        ]);

        $query->andFilterWhere(['like', 'method', $this->method])
            ->andFilterWhere(['like', 'site_name', $this->site_name])
            ->andFilterWhere(['like', 'param_name', $this->param_name])
            ->andFilterWhere(['like', 'svc_ip', $this->svc_ip]);

        return $dataProvider;
        */


    }
}
