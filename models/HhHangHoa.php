<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hh_hang_hoa".
 *
 * @property int $id
 * @property string $ten_hang_hoa
 * @property string|null $ma_hang_hoa
 * @property string $ngay_san_xuat
 * @property int|null $so_luong_ton_kho
 * @property int $don_gia
 * @property string|null $ghi_chu
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property KhChiTietDonHangKh[] $khChiTietDonHangKhs
 * @property NccChiTietDonHangNcc[] $nccChiTietDonHangNccs
 */
class HhHangHoa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hh_hang_hoa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ten_hang_hoa', 'ngay_san_xuat', 'don_gia'], 'required'],
            [['ngay_san_xuat', 'thoi_gian_tao'], 'safe'],
            [['so_luong_ton_kho', 'don_gia', 'nguoi_tao'], 'integer'],
            [['ghi_chu'], 'string'],
            [['ten_hang_hoa'], 'string', 'max' => 255],
            [['ma_hang_hoa'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ten_hang_hoa' => 'Ten Hang Hoa',
            'ma_hang_hoa' => 'Ma Hang Hoa',
            'ngay_san_xuat' => 'Ngay San Xuat',
            'so_luong_ton_kho' => 'So Luong Ton Kho',
            'don_gia' => 'Don Gia',
            'ghi_chu' => 'Ghi Chu',
            'nguoi_tao' => 'Nguoi Tao',
            'thoi_gian_tao' => 'Thoi Gian Tao',
        ];
    }

    /**
     * Gets query for [[KhChiTietDonHangKhs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKhChiTietDonHangKhs()
    {
        return $this->hasMany(KhChiTietDonHangKh::class, ['id_hang_hoa' => 'id']);
    }

    /**
     * Gets query for [[NccChiTietDonHangNccs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNccChiTietDonHangNccs()
    {
        return $this->hasMany(NccChiTietDonHangNcc::class, ['id_hang_hoa' => 'id']);
    }
}
