<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Logs;

/**
 * LogsSearch represents the model behind the search form about `frontend\models\Logs`.
 */
class LogsSearch extends Logs
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'log_type', 'date_day', 'start_time', 'end_time'], 'integer'],
            [['method', 'param_value', 'description', 'svc_ip', 'site_name'], 'safe'],
            [['execute_time'], 'number'],
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
        $query = Logs::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
//            'start_time' => $this->start_time,
//            'end_time' => $this->end_time,
            'execute_time' => $this->execute_time,
            'status' => $this->status,
            'log_type' => $this->log_type,
            'date_day' => $this->date_day,
        ]);

        $query->andFilterWhere(['like', 'method', $this->method])
            ->andFilterWhere(['like', 'param_value', $this->param_value])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'svc_ip', $this->svc_ip])
            ->andFilterWhere(['like', 'site_name', $this->site_name])
            ->andFilterWhere(['>=', 'start_time', $this->start_time])
            ->andFilterWhere(['<=', 'end_time', $this->end_time])
        ;

        return $dataProvider;
    }
}
