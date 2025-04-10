<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ct_gia_tri_tam_ung".
 *
 * @property int $id
 * @property int $id_cong_trinh
 * @property int $so_tien
 * @property string $ngay_thang_bao_lanh
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property CtCongTrinh $congTrinh
 */
class CtGiaTriTamUng extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ct_gia_tri_tam_ung';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cong_trinh', 'so_tien', 'ngay_thang_bao_lanh'], 'required'],
            [['id_cong_trinh', 'so_tien', 'nguoi_tao'], 'integer'],
            [['ngay_thang_bao_lanh', 'thoi_gian_tao'], 'safe'],
            [['id_cong_trinh'], 'exist', 'skipOnError' => true, 'targetClass' => CtCongTrinh::class, 'targetAttribute' => ['id_cong_trinh' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_cong_trinh' => 'Id Cong Trinh',
            'so_tien' => 'So Tien',
            'ngay_thang_bao_lanh' => 'Ngay Thang Bao Lanh',
            'nguoi_tao' => 'Nguoi Tao',
            'thoi_gian_tao' => 'Thoi Gian Tao',
        ];
    }

    /**
     * Gets query for [[CongTrinh]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCongTrinh()
    {
        return $this->hasOne(CtCongTrinh::class, ['id' => 'id_cong_trinh']);
    }
}
