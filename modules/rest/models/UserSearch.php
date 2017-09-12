<?php

namespace app\modules\rest\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\rest\models\User;
use app\modules\rest\models\Phone;

/**
 * UserSearch represents the model behind the search form about `app\modules\rest\models\User`.
 */
class UserSearch extends User
{
    public $phones;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['firstName', 'lastName','phones'], 'safe'],
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
        $query = User::find();
      //  $query->joinWith(['phones']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $dataProvider->sort->attributes['phones'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['phones.phone' => SORT_ASC],
            'desc' => ['phones.phone' => SORT_DESC],
        ];

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);
//echo '<pre>';
//var_dump($query);
//die();
        $query->andFilterWhere(['like', 'firstName', $this->firstName])
            ->andFilterWhere(['like', 'lastName', $this->lastName])
         //   ->            andFilterWhere(['like', 'phones.phone', $this->phones])
        ;;
        $query->joinWith(['phones' => function ($query) {
            $query->from(['phones' => Phone::tableName()]);
        }]);

        return $dataProvider;
    }
}
