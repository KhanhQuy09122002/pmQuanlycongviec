<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ct_vat_tu_thanh_toan".
 *
 * @property int $id
 * @property int $id_cong_trinh
 * @property string $ten_vat_tu
 * @property string|null $don_vi_tinh
 * @property int $so_luong
 * @property int $don_gia
 * @property double $thanh_tien
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property CtCongTrinh $congTrinh
 */
class CtVatTuThanhToan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ct_vat_tu_thanh_toan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cong_trinh', 'ten_vat_tu', 'so_luong', 'don_gia', 'thanh_tien'], 'required'],
            [['id_cong_trinh', 'so_luong', 'don_gia', 'nguoi_tao'], 'integer'],
            [['thanh_tien'],'number'],
            [['thoi_gian_tao'], 'safe'],
            [['ten_vat_tu'], 'string', 'max' => 255],
            [['don_vi_tinh'], 'string', 'max' => 50],
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
            'ten_vat_tu' => 'Ten Vat Tu',
            'so_luong' => 'So Luong',
            'don_gia' => 'Don Gia',
            'thanh_tien' => 'Thanh Tien',
            'don_vi_tinh'=>'Don vi tinh',
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
