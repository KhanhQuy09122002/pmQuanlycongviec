<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ncc_chi_tiet_don_hang_ncc".
 *
 * @property int $id
 * @property int $id_don_hang
 * @property int $id_hang_hoa
 * @property int $so_luong
 * @property int $thanh_tien
 * @property int|null $nguoi_tao
 * @property string|null $thoi_gian_tao
 *
 * @property NccDonHangNhaCungCap $donHang
 * @property HhHangHoa $hangHoa
 */
class NccChiTietDonHangNcc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ncc_chi_tiet_don_hang_ncc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_don_hang', 'id_hang_hoa', 'so_luong', 'thanh_tien'], 'required'],
            [['id_don_hang', 'id_hang_hoa', 'so_luong', 'thanh_tien', 'nguoi_tao'], 'integer'],
            [['thoi_gian_tao'], 'safe'],
            [['id_don_hang'], 'exist', 'skipOnError' => true, 'targetClass' => NccDonHangNhaCungCap::class, 'targetAttribute' => ['id_don_hang' => 'id']],
            [['id_hang_hoa'], 'exist', 'skipOnError' => true, 'targetClass' => HhHangHoa::class, 'targetAttribute' => ['id_hang_hoa' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_don_hang' => 'Id Don Hang',
            'id_hang_hoa' => 'Id Hang Hoa',
            'so_luong' => 'So Luong',
            'thanh_tien' => 'Thanh Tien',
            'nguoi_tao' => 'Nguoi Tao',
            'thoi_gian_tao' => 'Thoi Gian Tao',
        ];
    }

    /**
     * Gets query for [[DonHang]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDonHang()
    {
        return $this->hasOne(NccDonHangNhaCungCap::class, ['id' => 'id_don_hang']);
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
