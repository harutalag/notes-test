<?php

namespace frontend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Club;

/**
 * ClubSearch represents the model behind the search form of `common\models\Club`.
 */
class ClubSearch extends Club
{
    public $archive;
    public $ser_user;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'archive'], 'integer'],
            [['name', 'address', 'ser_user'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Club::find()->alias('t')->joinWith('createdBy c');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,

        ]);
        $dataProvider->sort->attributes['ser_user'] = [
            'asc'  => ['c.username' => SORT_ASC],
            'desc' => ['c.username' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            't.id' => $this->id,
        ]);
        if (!$this->archive){
            $query->andFilterWhere(['!=','t.status', Club::STATUS_DELETED]);
        }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'c.username', $this->ser_user]);

        return $dataProvider;
    }
}
