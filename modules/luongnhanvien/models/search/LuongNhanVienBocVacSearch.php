<?php

namespace app\modules\luongnhanvien\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\luongnhanvien\models\LuongNhanVienBocVac;

/**
 * LuongNhanVienBocVacSearch represents the model behind the search form about `app\modules\luongnhanvien\models\LuongNhanVienBocVac`.
 */
class LuongNhanVienBocVacSearch extends LuongNhanVienBocVac
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_nhan_vien_boc_vac' ,'so_tien', 'da_nhan', 'nguoi_tao'], 'integer'],
            [['thoi_gian_tao','ngay_thang'], 'safe'],
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
        $query = LuongNhanVienBocVac::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        if (!empty($this->ngay_thang)) {
            $ngay = \DateTime::createFromFormat('d/m/Y', $this->ngay_thang);
            if ($ngay) {
                $query->andFilterWhere(['ngay_thang' => $ngay->format('Y-m-d')]);
            }
        }
        
        $query->andFilterWhere([
            'id' => $this->id,
            'id_nhan_vien_boc_vac' => $this->id_nhan_vien_boc_vac,
           // 'ngay_thang' => $this->ngay_thang,
            'so_tien' => $this->so_tien,
            'da_nhan' => $this->da_nhan,
            'nguoi_tao' => $this->nguoi_tao,
            'thoi_gian_tao' => $this->thoi_gian_tao,
        ]);

        return $dataProvider;
    }
}
