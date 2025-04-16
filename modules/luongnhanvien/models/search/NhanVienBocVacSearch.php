<?php

namespace app\modules\luongnhanvien\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\luongnhanvien\models\NhanVienBocVac;

/**
 * LNhanVienBocVacSearch represents the model behind the search form about `app\modules\luongnhanvien\models\NhanVienBocVac`.
 */
class NhanVienBocVacSearch extends NhanVienBocVac
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'muc_luong', 'nguoi_tao'], 'integer'],
            [['ho_ten', 'so_dien_thoai', 'so_cccd', 'hinh_anh', 'trang_thai', 'thoi_gian_tao'], 'safe'],
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
        $query = NhanVienBocVac::find();

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
            'muc_luong' => $this->muc_luong,
            'nguoi_tao' => $this->nguoi_tao,
            'thoi_gian_tao' => $this->thoi_gian_tao,
        ]);

        $query->andFilterWhere(['like', 'ho_ten', $this->ho_ten])
            ->andFilterWhere(['like', 'so_dien_thoai', $this->so_dien_thoai])
            ->andFilterWhere(['like', 'so_cccd', $this->so_cccd])
            ->andFilterWhere(['like', 'hinh_anh', $this->hinh_anh])
            ->andFilterWhere(['like', 'trang_thai', $this->trang_thai]);

        return $dataProvider;
    }
}
