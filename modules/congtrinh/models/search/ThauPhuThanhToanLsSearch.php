<?php

namespace app\modules\congtrinh\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\congtrinh\models\ThauPhuThanhToanLs;

/**
 * ThauPhuThanhToanLsSearch represents the model behind the search form about `app\modules\congtrinh\models\ThauPhuThanhToanLs`.
 */
class ThauPhuThanhToanLsSearch extends ThauPhuThanhToanLs
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_thau_phu_thanh_toan', 'so_tien', 'nguoi_tao'], 'integer'],
            [['ngay_thanh_toan', 'ghi_chu', 'thoi_gian_tao'], 'safe'],
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
        $query = ThauPhuThanhToanLs::find();

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
            'id_thau_phu_thanh_toan' => $this->id_thau_phu_thanh_toan,
            'ngay_thanh_toan' => $this->ngay_thanh_toan,
            'so_tien' => $this->so_tien,
            'nguoi_tao' => $this->nguoi_tao,
            'thoi_gian_tao' => $this->thoi_gian_tao,
        ]);

        $query->andFilterWhere(['like', 'ghi_chu', $this->ghi_chu]);

        return $dataProvider;
    }
}
