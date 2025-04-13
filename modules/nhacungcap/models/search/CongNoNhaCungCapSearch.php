<?php

namespace app\modules\nhacungcap\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\nhacungcap\models\CongNoNhaCungCap;

/**
 * CongNoNhaCungCapSearch represents the model behind the search form about `app\modules\nhacungcap\models\CongNoNhaCungCap`.
 */
class CongNoNhaCungCapSearch extends CongNoNhaCungCap
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_nha_cung_cap', 'so_tien', 'nguoi_tao'], 'integer'],
            [['loai_cong_no', 'ghi_chu', 'ngay_phat_sinh', 'thoi_gian_tao'], 'safe'],
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
        $query = CongNoNhaCungCap::find();

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
            'id_nha_cung_cap' => $this->id_nha_cung_cap,
            'so_tien' => $this->so_tien,
            'ngay_phat_sinh' => $this->ngay_phat_sinh,
            'nguoi_tao' => $this->nguoi_tao,
            'thoi_gian_tao' => $this->thoi_gian_tao,
        ]);

        $query->andFilterWhere(['like', 'loai_cong_no', $this->loai_cong_no])
            ->andFilterWhere(['like', 'ghi_chu', $this->ghi_chu]);

        return $dataProvider;
    }
}
