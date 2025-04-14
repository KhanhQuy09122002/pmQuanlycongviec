<?php

namespace app\modules\khachhang\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\khachhang\models\DonHangKhachHang;

/**
 * DonHangKhachHangSearch represents the model behind the search form about `app\modules\khachhang\models\DonHangKhachHang`.
 */
class DonHangKhachHangSearch extends DonHangKhachHang
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_khach_hang', 'so_don_hang', 'tong_tien', 'da_giao_hang', 'chi_phi_van_chuyen', 'nguoi_tao'], 'integer'],
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
        $query = DonHangKhachHang::find();

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
            'id_khach_hang' => $this->id_khach_hang,
            'so_don_hang' => $this->so_don_hang,
            'ngay_dat_hang' => $this->ngay_dat_hang,
            'tong_tien' => $this->tong_tien,
            'da_giao_hang' => $this->da_giao_hang,
            'ngay_giao_hang' => $this->ngay_giao_hang,
            'chi_phi_van_chuyen' => $this->chi_phi_van_chuyen,
            'nguoi_tao' => $this->nguoi_tao,
            'thoi_gian_tao' => $this->thoi_gian_tao,
        ]);

        return $dataProvider;
    }
}
