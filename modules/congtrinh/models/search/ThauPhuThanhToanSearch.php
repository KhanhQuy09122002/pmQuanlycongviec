<?php

namespace app\modules\congtrinh\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\congtrinh\models\ThauPhuThanhToan;

/**
 * ThauPhuThanhToanSearch represents the model behind the search form about `app\modules\congtrinh\models\ThauPhuThanhToan`.
 */
class ThauPhuThanhToanSearch extends ThauPhuThanhToan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_cong_trinh', 'tong_hop_dong', 'da_thanh_toan', 'con_lai', 'nguoi_tao'], 'integer'],
            [['ten_cong_viec', 'thoi_gian_tao'], 'safe'],
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
        $query = ThauPhuThanhToan::find();

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
            'id_cong_trinh' => $this->id_cong_trinh,
            'tong_hop_dong' => $this->tong_hop_dong,
            'da_thanh_toan' => $this->da_thanh_toan,
            'con_lai' => $this->con_lai,
            'nguoi_tao' => $this->nguoi_tao,
            'thoi_gian_tao' => $this->thoi_gian_tao,
        ]);

        $query->andFilterWhere(['like', 'ten_cong_viec', $this->ten_cong_viec]);

        return $dataProvider;
    }
}
