<?php

namespace frontend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Notes;

/**
 * NotesSearch represents the model behind the search form of `common\models\Notes`.
 */
class NotesSearch extends Notes
{
    public $checked_tags;
    public $selected_user;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'order', 'status', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['title', 'text', 'checked_tags', 'selected_user'], 'safe'],
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
        $query = Notes::find()->andWhere(['user_id'=> \Yii::$app->user->id]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if ($this->checked_tags){
            $query->joinWith('notesHasTags');
            $query->andFilterWhere([ 'tag_id' => $this->checked_tags]);
        }
        if ($this->selected_user){
            $query->joinWith('user');
            $query->andFilterWhere(['like', 'user.email', $this->selected_user]);
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'order' => $this->order,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
