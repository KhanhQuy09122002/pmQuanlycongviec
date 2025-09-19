<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ct_vat_tu_thanh_toan".
 *
 * @property int $id
 * @property int $id_cong_trinh
 * @property int $id_hang_hoa
 * @property string $ten_vat_tu
 * @property string|null $don_vi_tinh
 * @property float $so_luong
 * @property float $don_gia
 * @property float $thanh_tien
 * @property string|null $ngay_thanh_toan
 * @property string|null $ghi_chu
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property CtCongTrinh $congTrinh
 * @property HhHangHoa $hangHoa
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
            [['don_vi_tinh', 'ngay_thanh_toan', 'ghi_chu', 'nguoi_tao', 'thoi_gian_tao'], 'default', 'value' => null],
            [['id_cong_trinh', 'id_hang_hoa', 'ten_vat_tu', 'so_luong', 'don_gia', 'thanh_tien'], 'required'],
            [['id_cong_trinh', 'id_hang_hoa', 'nguoi_tao'], 'integer'],
            [['so_luong', 'don_gia', 'thanh_tien'], 'number'],
            [['ngay_thanh_toan', 'thoi_gian_tao'], 'safe'],
            [['ghi_chu'], 'string'],
            [['ten_vat_tu'], 'string', 'max' => 255],
            [['don_vi_tinh'], 'string', 'max' => 50],
            [['id_hang_hoa'], 'exist', 'skipOnError' => true, 'targetClass' => HhHangHoa::class, 'targetAttribute' => ['id_hang_hoa' => 'id']],
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
            'id_hang_hoa' => 'Id Hang Hoa',
            'ten_vat_tu' => 'Ten Vat Tu',
            'don_vi_tinh' => 'Don Vi Tinh',
            'so_luong' => 'So Luong',
            'don_gia' => 'Don Gia',
            'thanh_tien' => 'Thanh Tien',
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

    /**
     * Gets query for [[HangHoa]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHangHoa()
    {
        return $this->hasOne(HhHangHoa::class, ['id' => 'id_hang_hoa']);
    }

}
