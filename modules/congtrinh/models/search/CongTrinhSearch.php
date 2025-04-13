<?php

namespace app\modules\congtrinh\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\congtrinh\models\CongTrinh;

/**
 * CongTrinhSearch represents the model behind the search form about `app\modules\congtrinh\models\CongTrinh`.
 */
class CongTrinhSearch extends CongTrinh
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'gia_tri_hop_dong', 'gia_tri_tam_ung', 'gia_tri_bao_lanh_thoi_han_hop_dong', 'gia_tri_bao_hanh', 'gia_tri_da_thanh_toan', 'gia_tri_hop_dong_con_lai', 'khoi_luong_phat_sinh_tang_giam', 'nguoi_tao'], 'integer'],
            [['ten_cong_trinh', 'dia_diem', 'thoi_han_hop_dong_tu_ngay', 'thoi_han_hop_dong_den_ngay', 'trang_thai', 'thoi_gian_tao'], 'safe'],
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
        $query = CongTrinh::find();

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
            'gia_tri_hop_dong' => $this->gia_tri_hop_dong,
            'thoi_han_hop_dong_tu_ngay' => $this->thoi_han_hop_dong_tu_ngay,
            'thoi_han_hop_dong_den_ngay' => $this->thoi_han_hop_dong_den_ngay,
            'gia_tri_tam_ung' => $this->gia_tri_tam_ung,
            'gia_tri_bao_lanh_thoi_han_hop_dong' => $this->gia_tri_bao_lanh_thoi_han_hop_dong,
            'gia_tri_bao_hanh' => $this->gia_tri_bao_hanh,
            'gia_tri_da_thanh_toan' => $this->gia_tri_da_thanh_toan,
            'gia_tri_hop_dong_con_lai' => $this->gia_tri_hop_dong_con_lai,
            'khoi_luong_phat_sinh_tang_giam' => $this->khoi_luong_phat_sinh_tang_giam,
            'nguoi_tao' => $this->nguoi_tao,
            'thoi_gian_tao' => $this->thoi_gian_tao,
        ]);

        $query->andFilterWhere(['like', 'ten_cong_trinh', $this->ten_cong_trinh])
            ->andFilterWhere(['like', 'dia_diem', $this->dia_diem])
            ->andFilterWhere(['like', 'trang_thai', $this->trang_thai]);

        return $dataProvider;
    }
}
