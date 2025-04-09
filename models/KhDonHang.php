<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kh_don_hang".
 *
 * @property int $id
 * @property int $id_khach_hang
 * @property int $so_don_hang
 * @property string $ngay_dat_hang
 * @property int|null $tong_tien
 * @property int|null $da_giao_hang
 * @property string|null $ngay_giao_hang
 * @property int|null $chi_phi_van_chuyen
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property KhChiTietDonHangKh[] $khChiTietDonHangKhs
 * @property KhKhachHang $khachHang
 */
class KhDonHang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kh_don_hang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_khach_hang', 'so_don_hang', 'ngay_dat_hang'], 'required'],
            [['id_khach_hang', 'so_don_hang', 'tong_tien', 'da_giao_hang', 'chi_phi_van_chuyen', 'nguoi_tao'], 'integer'],
            [['ngay_dat_hang', 'ngay_giao_hang', 'thoi_gian_tao'], 'safe'],
            [['id_khach_hang'], 'exist', 'skipOnError' => true, 'targetClass' => KhKhachHang::class, 'targetAttribute' => ['id_khach_hang' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_khach_hang' => 'Id Khach Hang',
            'so_don_hang' => 'So Don Hang',
            'ngay_dat_hang' => 'Ngay Dat Hang',
            'tong_tien' => 'Tong Tien',
            'da_giao_hang' => 'Da Giao Hang',
            'ngay_giao_hang' => 'Ngay Giao Hang',
            'chi_phi_van_chuyen' => 'Chi Phi Van Chuyen',
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
        return $this->hasMany(KhChiTietDonHangKh::class, ['id_don_hang' => 'id']);
    }

    /**
     * Gets query for [[KhachHang]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKhachHang()
    {
        return $this->hasOne(KhKhachHang::class, ['id' => 'id_khach_hang']);
    }
}
