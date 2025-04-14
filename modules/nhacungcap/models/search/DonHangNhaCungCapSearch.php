<?php

namespace app\modules\nhacungcap\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\nhacungcap\models\DonHangNhaCungCap;

/**
 * DonHangNhaCungCapSearch represents the model behind the search form about `app\modules\nhacungcap\models\DonHangNhaCungCap`.
 */
class DonHangNhaCungCapSearch extends DonHangNhaCungCap
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_nha_cung_cap', 'so_don_hang', 'tong_tien', 'da_giao_hang', 'nguoi_tao'], 'integer'],
            [['ngay_dat_hang', 'ngay_giao_hang', 'thoi_gian_tao'], 'safe'],
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
        $query = DonHangNhaCungCap::find();

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
            'so_don_hang' => $this->so_don_hang,
            'ngay_dat_hang' => $this->ngay_dat_hang,
            'tong_tien' => $this->tong_tien,
            'da_giao_hang' => $this->da_giao_hang,
            'ngay_giao_hang' => $this->ngay_giao_hang,
            'nguoi_tao' => $this->nguoi_tao,
            'thoi_gian_tao' => $this->thoi_gian_tao,
        ]);

        return $dataProvider;
    }
}
