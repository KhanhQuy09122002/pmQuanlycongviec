<?php

namespace app\modules\khachhang\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\khachhang\models\CongNoKhachHang;

/**
 * CongNoKhachHangSearch represents the model behind the search form about `app\modules\khachhang\models\CongNoKhachHang`.
 */
class CongNoKhachHangSearch extends CongNoKhachHang
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_khach_hang', 'so_tien', 'nguoi_tao'], 'integer'],
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
        $query = CongNoKhachHang::find();

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
