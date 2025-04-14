<?php

namespace app\modules\congtrinh\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\congtrinh\models\GiaTriBaoHanh;

/**
 * GiaTriBaoHanhSearch represents the model behind the search form about `app\modules\congtrinh\models\GiaTriBaoHanh`.
 */
class GiaTriBaoHanhSearch extends GiaTriBaoHanh
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_cong_trinh', 'so_tien', 'nguoi_tao'], 'integer'],
            [['ngay_thang_bao_hanh', 'thoi_gian_tao'], 'safe'],
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
        $query = GiaTriBaoHanh::find();

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
            'so_tien' => $this->so_tien,
            'ngay_thang_bao_hanh' => $this->ngay_thang_bao_hanh,
            'nguoi_tao' => $this->nguoi_tao,
            'thoi_gian_tao' => $this->thoi_gian_tao,
        ]);

        return $dataProvider;
    }
}
