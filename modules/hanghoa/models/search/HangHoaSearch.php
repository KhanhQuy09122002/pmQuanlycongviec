<?php

namespace app\modules\hanghoa\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\hanghoa\models\HangHoa;

/**
 * HangHoaSearch represents the model behind the search form about `app\modules\hanghoa\models\HangHoa`.
 */
class HangHoaSearch extends HangHoa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'so_luong_ton_kho', 'don_gia', 'nguoi_tao'], 'integer'],
            [['ten_hang_hoa', 'ma_hang_hoa', 'ngay_san_xuat', 'ghi_chu', 'thoi_gian_tao'], 'safe'],
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
        $query = HangHoa::find();

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
            'ngay_san_xuat' => $this->ngay_san_xuat,
            'so_luong_ton_kho' => $this->so_luong_ton_kho,
            'don_gia' => $this->don_gia,
            'nguoi_tao' => $this->nguoi_tao,
            'thoi_gian_tao' => $this->thoi_gian_tao,
        ]);

        $query->andFilterWhere(['like', 'ten_hang_hoa', $this->ten_hang_hoa])
            ->andFilterWhere(['like', 'ma_hang_hoa', $this->ma_hang_hoa])
            ->andFilterWhere(['like', 'ghi_chu', $this->ghi_chu]);

        return $dataProvider;
    }
}
