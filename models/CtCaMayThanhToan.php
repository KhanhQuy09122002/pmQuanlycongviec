<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ct_ca_may_thanh_toan".
 *
 * @property int $id
 * @property int $id_cong_trinh
 * @property string $ten_ca_may
 * @property float $so_tien
 * @property string|null $ngay_thanh_toan
 * @property string|null $ghi_chu
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property CtCongTrinh $congTrinh
 */
class CtCaMayThanhToan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ct_ca_may_thanh_toan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ngay_thanh_toan', 'ghi_chu', 'nguoi_tao', 'thoi_gian_tao'], 'default', 'value' => null],
            [['id_cong_trinh', 'ten_ca_may', 'so_tien'], 'required'],
            [['id_cong_trinh', 'nguoi_tao'], 'integer'],
            [['so_tien'], 'number'],
            [['ngay_thanh_toan', 'thoi_gian_tao'], 'safe'],
            [['ghi_chu'], 'string'],
            [['ten_ca_may'], 'string', 'max' => 255],
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
            'ten_ca_may' => 'Ten Ca May',
            'so_tien' => 'So Tien',
            'ngay_thanh_toan' => 'Ngay Thanh Toan',
            'ghi_chu' => 'Ghi Chu',
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
