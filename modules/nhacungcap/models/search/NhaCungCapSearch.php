<?php

namespace app\modules\nhacungcap\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\nhacungcap\models\NhaCungCap;

/**
 * NhaCungCapSearch represents the model behind the search form about `app\modules\nhacungcap\models\NhaCungCap`.
 */
class NhaCungCapSearch extends NhaCungCap
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tong_hop_cong_no', 'da_thanh_toan', 'con_lai', 'nguoi_tao'], 'integer'],
            [['ten_nha_cung_cap', 'so_dien_thoai', 'dia_chi', 'thoi_gian_tao'], 'safe'],
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
        $query = NhaCungCap::find();

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
            'tong_hop_cong_no' => $this->tong_hop_cong_no,
            'da_thanh_toan' => $this->da_thanh_toan,
            'con_lai' => $this->con_lai,
            'nguoi_tao' => $this->nguoi_tao,
            'thoi_gian_tao' => $this->thoi_gian_tao,
        ]);

        $query->andFilterWhere(['like', 'ten_nha_cung_cap', $this->ten_nha_cung_cap])
            ->andFilterWhere(['like', 'so_dien_thoai', $this->so_dien_thoai])
            ->andFilterWhere(['like', 'dia_chi', $this->dia_chi]);

        return $dataProvider;
    }
}
